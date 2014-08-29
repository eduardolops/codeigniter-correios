<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Codeigniter Correios API v1.0</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Codeigniter Correios API v1.0</h1>

	<div id="body">
		
		<p>Controller:</p>
		<code>
		//Documentation:<br/><br/>
		$this->load->library('cifrete');
		<br/><br/>
		$this->cifrete->setCepOrigem('01310940');<br/>
		$this->cifrete->setCepDestino('64000020');<br/>
		$this->cifrete->setMaoPropria('s');<br/>
		$this->cifrete->setAvisoRecebimento('s');<br/>
		$this->cifrete->setDiametro('0');<br/>
		$this->cifrete->setValor('0');<br/>
		$this->cifrete->setComprimento('30');<br/>
		$this->cifrete->setLargura('30');<br/>
		$this->cifrete->setAltura('30');<br/>
		$this->cifrete->setPeso('1');<br/>
		$this->cifrete->setFormato('1');<br/>
		$this->cifrete->setEmpresaSenha('');<br/>
		$this->cifrete->setEmpresaCodigo('');<br/>
		$this->cifrete->setPacRetorno(TRUE);<br/>
		$this->cifrete->setSedexRetorno(TRUE);<br/>
		$this->cifrete->setESedexRetorno(FALSE);<br/>
		$this->cifrete->calcular();
		<br/><br/>
		$data['preco_pac'] = $this->cifrete->getResultadoPac();<br/>
		$data['preco_sedex'] = $this->cifrete->getResultadoSedex();<br/>
		$data['preco_esedex'] = $this->cifrete->getResultadoESedex();
		<br/><br/>
		$data['preco_pac_prazo'] = $this->cifrete->getResultadoPacEntrega();<br/>
		$data['preco_sedex_prazo'] = $this->cifrete->getResultadoSedexEntrega();<br/>
		$data['preco_esedex_prazo'] = $this->cifrete->getResultadoESedexEntrega();
		<br/><br/>
		$this->load->view('welcome_message',$data);
		</code>
		
		<p>Resultado na View:</p>
		<code>Preço PAC: <?php echo $preco_pac; ?> <?php echo $preco_pac_prazo; ?> dias</code>
		<code>Preço SEDEX: <?php echo $preco_sedex; ?> <?php echo $preco_sedex_prazo; ?> dias</code>
		<code>Preço E-SEDEX: <?php echo $preco_esedex; ?> <?php echo $preco_esedex_prazo; ?> dias</code>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>