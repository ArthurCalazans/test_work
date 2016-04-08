<?php
if(isset($_POST['enviar']))
{
	$_SESSION['taxa'][0] = $_POST['ir_01']/100;
	$_SESSION['taxa'][1] = $_POST['ir_02']/100;
	$_SESSION['taxa'][2] = $_POST['ir_03']/100;
	$_SESSION['taxa'][3] = $_POST['ir_04']/100;
	$_SESSION['taxa']['pis'][0] = $_POST['pis_01']/100;
	$_SESSION['taxa']['pis'][1] = $_POST['pis_02']/100;
	$_SESSION['taxa']['cofins'][0] = $_POST['cofins_01']/100;
	$_SESSION['taxa']['cofins'][1] = $_POST['cofins_02']/100;
	$_SESSION['taxa']['csll'][0] = $_POST['csll_01']/100;
	$_SESSION['taxa']['csll'][1] = $_POST['csll_02']/100;
}elseif(isset($_POST['resetar']))
{
	session_unset();
}


if(empty($_SESSION['taxa']))
{
	$_SESSION['taxa'][0] = 0.075;
	$_SESSION['taxa'][1] = 0.15;
	$_SESSION['taxa'][2] = 0.225;
	$_SESSION['taxa'][3] = 0.275;
	$_SESSION['taxa']['pis'][0] = 0.0065;
	$_SESSION['taxa']['pis'][1] = 0.0165;
	$_SESSION['taxa']['cofins'][0] = 0.03;
	$_SESSION['taxa']['cofins'][1] = 0.076;
	$_SESSION['taxa']['csll'][0] = 0.32;
	$_SESSION['taxa']['csll'][1] = 0.09;
}

$amount = empty($_POST['amount']) ? 0 : $_POST['amount'];

	if($amount<=1903.98 and $amount > 0)
	{
		$ir_amount = 'Exempted';	
	}elseif($amount >= 1903.99 and $amount <= 2826.65)
	{		
		$deduzir = 142.80;
		$ir_amount = ($amount*$_SESSION['taxa'][0])-$deduzir;
		$ir_amount = number_format($ir_amount,2,',','.');
	}elseif($amount >=  2826.66 and $amount <= 3751.05)
	{
		$deduzir = 354.80;
		$ir_amount = ($amount*$_SESSION['taxa'][1])-$deduzir;
		$ir_amount = number_format($ir_amount,2,',','.');		
	}elseif($amount >= 3751.06 and $amount <= 4664.68)
	{
		$deduzir = 636.13;
		$ir_amount = ($amount*$_SESSION['taxa'][2])-$deduzir;
		$ir_amount = number_format($ir_amount,2,',','.');		
	}elseif($amount>4665.69)
	{
		$deduzir = 869.36;
		$ir_amount = ($amount*$_SESSION['taxa'][3])-$deduzir;		
		$ir_amount = number_format($ir_amount,2,',','.');		
	}else
	{
		$amount = "no value";	
		$ir_amount = "no value";	
	}

if($amount>5000)
{	
	$pis[0] 	= number_format($amount * $_SESSION['taxa']['pis'][0],2,',','.');
	$pis[1]		= number_format($amount * $_SESSION['taxa']['pis'][1],2,',','.');
	$cofins[0] 	= number_format($amount * $_SESSION['taxa']['cofins'][0],2,',','.');
	$cofins[1] 	= number_format($amount * $_SESSION['taxa']['cofins'][1],2,',','.');
	$csll 		= number_format(($amount * 0.32)*0.09,2,',','.');
	
}else
{
	$pis[0] = "no value";
	$pis[1] = "no value";
	$cofins[0] = "no value";
	$cofins[1] = "no value";
	$csll = "no value";
}
if($amount>0)
{
	$amount 	= number_format($amount,2,',','.');
}
?>