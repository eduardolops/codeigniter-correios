codeigniter-correios
====================

CodeIgniter Library (Biblioteca) de calculo de frete com os correios, suporta PAC,SEDEX,E-SEDEX.

Controller:

$this->load->library('cifrete');

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

$data['preco_pac'] = $this->cifrete->getResultadoPac();<br/>
$data['preco_sedex'] = $this->cifrete->getResultadoSedex();<br/>
$data['preco_esedex'] = $this->cifrete->getResultadoESedex();

$data['preco_pac_prazo'] = $this->cifrete->getResultadoPacEntrega();<br/>
$data['preco_sedex_prazo'] = $this->cifrete->getResultadoSedexEntrega();<br/>
$data['preco_esedex_prazo'] = $this->cifrete->getResultadoESedexEntrega();

View:

$this->load->view('welcome_message',$data);

Resultado na View:

Preço PAC: <?php echo $preco_pac; ?> <?php echo $preco_pac_prazo; ?> dias
Preço SEDEX: <?php echo $preco_sedex; ?> <?php echo $preco_sedex_prazo; ?> dias
Preço E-SEDEX: <?php echo $preco_esedex; ?> <?php echo $preco_esedex_prazo; ?> dias