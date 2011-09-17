<?php
$_GET["sessionid"] = $_GET["sessionid"]=="" ? $_SESSION["pagseguro_id"] : $_GET["sessionid"];
require_once("pagseguro/pgs.php");
require_once("pagseguro/tratadados.php");

$nzshpcrt_gateways[$num]['name'] = 'PagSeguro';
$nzshpcrt_gateways[$num]['admin_name'] = 'PagSeguro';
$nzshpcrt_gateways[$num]['internalname'] = 'pagseguro';
$nzshpcrt_gateways[$num]['function'] = 'gateway_pagseguro';
$nzshpcrt_gateways[$num]['form'] = "form_pagseguro";
$nzshpcrt_gateways[$num]['submit_function'] = "submit_pagseguro";

/**
 * _process_gateway_pagseguro
 *
 * Tratamento dos dados antes de enviar para o gateway de pagamento.
 * Exibe o formulário com os dados para envio das informações requeridas
 * @param long $sessionid ID de referência para o pedido
 *
 */
function gateway_pagseguro($seperator, $sessionid) 
{
    global $wpdb, $wpsc_cart;

    // Carregando os dados
    $cart = unserialize($_SESSION['wpsc_cart']);
    
    $options = array(
        'email_cobranca' => get_option('pagseguro_email'),
        'ref_transacao'  => $cart->unique_id,   //$_SESSION['order_id'],
        'encoding'       => 'utf-8',
        'item_frete_1'   => number_format(($cart->total_tax + $cart->base_shipping) * 100, 0, '', ''),
    );

    $checkout_form_sql = "SELECT id, unique_name FROM `".WPSC_TABLE_CHECKOUT_FORMS."`";
    $checkout_form = $wpdb->get_results($checkout_form_sql,ARRAY_A) ;
    
    // Pega a referência dos campos de formulário definido pelo usuário                        
    foreach($checkout_form as $item){
        $collected_data[$item['unique_name']] = $item['id'];
    }        

    // Pega os dados do post
    $_client = $_POST["collected_data"];

    list($phone_prefix, $phone)   = trataTelefone($_client[if_isset($collected_data['billingphone'])]);

    $street = explode(',', $_client[if_isset($collected_data['billingaddress'])]);         
    $street = array_slice(array_merge($street, array("", "", "", "")), 0, 4); 
    list($rua, $numero, $complemento, $bairro) = $street;    

    $client = array (
        'nome'   => $_client['first_name'] . " " . $_client[if_isset($collected_data['billingfirstname'])],
        'cep'    => preg_replace("/[^0-9]/","", $_client[if_isset($collected_data['billingpostcode'])]),
        'end'    => $rua,
        'num'    => $numero,
        'compl'  => $complemento,
        'bairro' => $bairro,
        'cidade' => $_client[if_isset($collected_data['billingcity'])],
        'uf'     => $_client[if_isset($collected_data['billingstate'])],
        'pais'   => $_client[if_isset($collected_data['billingcountry'])][0],
        'ddd'    => $phone_prefix,
        'tel'    => $phone,  
        'email'  => $_client[if_isset($collected_data['billingemail'])]
    );

    $products = array();
    foreach($cart->cart_items as $item) {
        $products[] = array(
            "id"         => (string) $item->product_id,
            "descricao"  => $item->product_name,
            "quantidade" => $item->quantity,
            "valor"      => $item->unit_price,
            "peso"       => intval(round($item->weight * 453.59237))
        );
    }

    $PGS = New pgs($options);
    $PGS->cliente($client);	
    $PGS->adicionar($products);
    $show = array(
        "btn_submit"  => 0,
        "print"       => false, 
        "open_form"   => false,
        "show_submit" => false
    );

    $form = $PGS->mostra($show);

    $_SESSION["pagseguro_id"] = $sessionid;
    echo '<form id="form_pagseguro" action="https://pagseguro.uol.com.br/checkout/checkout.jhtml" method="post">',
        $form,
        '<script>window.onload=function(){form_pagseguro.submit();}</script>';

    // Esvazia o carrinho 
    $wpsc_cart->empty_cart();        
    exit();
}

function if_isset(&$a, $b = ''){
    return isset($a) ? $a : $b;
}

function submit_pagseguro() 
{
    if($_POST['pagseguro_email'] != null) {
        update_option('pagseguro_email', $_POST['pagseguro_email']);
    }
    if($_POST['pagseguro_token'] != null) {
        update_option('pagseguro_token', $_POST['pagseguro_token']);
    }
    return true;
}

/**
 * form_pagseguro
 *
 * Exibe o formulário de configuração do método de pagamento, dados do pagseguro
 * @return string Html do formulário
 *
 */
function form_pagseguro() 
{
    $output = "<tr>\n\r";
    $output .= "<tr>\n\r";
    $output .= "	<td colspan='2'>\n\r";
    $output .= "<strong>".TXT_WPSC_PAYMENT_INSTRUCTIONS_DESCR.":</strong><br />\n\r";
    $output .= "Email vendedor <input type=\"text\" name=\"pagseguro_email\" value=\"" . get_option('pagseguro_email') . "\"/><br/>\n\r";
    $output .= "TOKEN <input type=\"text\" name=\"pagseguro_token\" value=\"" . get_option('pagseguro_token') . "\"/><br/>\n\r";
    $output .= "<em>".TXT_WPSC_PAYMENT_INSTRUCTIONS_BELOW_DESCR."</em>\n\r";
    $output .= "	</td>\n\r";
    $output .= "</tr>\n\r";
    return $output;
}

/**
 * transact_url()
 *
 * Verifica o post do pagseguro e atualiza o pedido com o status da transação
 *
 */
function transact_url()
{
    if(!function_exists("retorno_automatico")) {
        define ('TOKEN', get_option("pagseguro_token"));
        function retorno_automatico ($post)
        {
            global $wpdb;
            switch(strtolower($post->StatusTransacao)) {
            case "completo":case "aprovado":
                $sql = "UPDATE `".WPSC_TABLE_PURCHASE_LOGS."` SET `processed`= '2' WHERE `sessionid`=".$post->Referencia;
                $wpdb->query($sql);
            case "cancelado":
                break;
            }
        }
        require_once("pagseguro/retorno.php");
    }
}

/**
 * pgs_return()
 *
 * Sensível ao carregamento da pág. de retorno (transaction_results), executa o 
 * transact_url caso tenha recebido um post
 *
 */
function pgs_return() {
    if ($_SERVER['REQUEST_METHOD']=='POST' and $_POST) {
        if( get_option('transact_url')=="http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]){ transact_url();}
    }
}
add_action('init', 'pgs_return');

