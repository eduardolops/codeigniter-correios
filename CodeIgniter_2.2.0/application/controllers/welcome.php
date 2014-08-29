<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->library('cifrete');
		
		$this->cifrete->setCepOrigem('01310940');
		$this->cifrete->setCepDestino('64000020');
		$this->cifrete->setMaoPropria('s');
		$this->cifrete->setAvisoRecebimento('s');
		$this->cifrete->setDiametro('0');
		$this->cifrete->setValor('0');
		$this->cifrete->setComprimento('30');
		$this->cifrete->setLargura('30');
		$this->cifrete->setAltura('30');
		$this->cifrete->setPeso('1');
		$this->cifrete->setFormato('1');
		$this->cifrete->setEmpresaSenha('');
		$this->cifrete->setEmpresaCodigo('');
		$this->cifrete->setPacRetorno(TRUE);
		$this->cifrete->setSedexRetorno(TRUE);
		$this->cifrete->setESedexRetorno(FALSE);
		$this->cifrete->calcular();
		
		$data['preco_pac'] = $this->cifrete->getResultadoPac();
		$data['preco_sedex'] = $this->cifrete->getResultadoSedex();
		$data['preco_esedex'] = $this->cifrete->getResultadoESedex();
		
		$data['preco_pac_prazo'] = $this->cifrete->getResultadoPacEntrega();
		$data['preco_sedex_prazo'] = $this->cifrete->getResultadoSedexEntrega();
		$data['preco_esedex_prazo'] = $this->cifrete->getResultadoESedexEntrega();
	
		$this->load->view('welcome_message',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */