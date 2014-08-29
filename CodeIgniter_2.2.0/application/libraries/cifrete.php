<?php
/*
* Codeigniter Correios v1.0
* @author Pietro vieira (deztyz@gmail.com)
* @gitgub https://github.com/pietrovieira/codeigniter-correios.git
*/
class Cifrete
{
	
	private $empresaCodigo = ""; //contrato e-sedex
    private $empresaSenha = ""; //contrato e-sedex
    private $cepOrigem = "43820080"; // cep de origem
    private $cepDestino = "76801032"; // cep de destino
    private $peso = '1'; //500 gr (0.5)
    private $formato = '1';
    private $altura = '30'; //cm
    private $largura = '30'; //cm
    private $comprimento = '30'; //cm
    private $valor = '0'; //valor declarado (seguro)
    private $diametro = '0';
	private $maoPropria = 's';
	private $avisoRecebimento = 's';
	//private $retorno = 'xml';
	private $resultadoPac = 0;
	private $resultadoSedex = 0;
	private $resultadoESedex = 0;
	private $resultadoPacEntrega;
	private $resultadoSedexEntrega;
	private $resultadoESedexEntrega;
	private $pacRetorno = TRUE;
	private $sedexRetorno = TRUE;
	private $eSedexRetorno = FALSE;
    private $erro;

	//sets
	public function setAvisoRecebimento($string){
		$this->avisoRecebimento = $string;
	}
	public function setMaoPropria($string){
		$this->maoPropria = $string;
	}
	public function setDiametro($string){
		$this->diametro = $string;
	}
	public function setValor($string){
		$this->valor = $string;
	}
	public function setComprimento($string){
		$this->comprimento = $string;
	}
	public function setLargura($string){
		$this->largura = $string;
	}
	public function setAltura($string){
		$this->altura = $string;
	}
	public function setFormato($string){
		$this->formato = $string;	
	}
	public function setPeso($string){
		$this->peso = $string;	
	}
	public function setCepOrigem($string){
		$this->cepOrigem = $string;
	}
	public function setCepDestino($string){
		$this->cepDestino = $string;	
	}
	public function setEmpresaSenha($string){
		$this->empresaSenha = $string;	
	}
	public function setEmpresaCodigo($string){
		$this->empresaCodigo = $string;	
	}
	public function setPacRetorno($bool){
		$this->pacRetorno = $bool;		
	}
	public function setSedexRetorno($bool){
		$this->sedexRetorno = $bool;	
	}
	public function setESedexRetorno($bool){
		$this->eSedexRetorno = $bool;
	}
	
	//gets
	public function getResultadoPac(){
		return $this->resultadoPac;
	}
	
	public function getResultadoSedex(){
		return $this->resultadoSedex;
	}
	
	public function getResultadoESedex(){
		return $this->resultadoESedex;
	}
	
	public function getResultadoPacEntrega(){
		return $this->resultadoPacEntrega;
	}
	
	public function getResultadoSedexEntrega(){
		return $this->resultadoSedexEntrega;
	}
	
	public function getResultadoESedexEntrega(){
		return $this->resultadoESedexEntrega;
	}
	
	public function getErro(){
		return $this->erro;
	}
	
	//calc
	public function calcular()
	{
		 $data['nCdEmpresa'] = $this->empresaCodigo;
		 $data['sDsSenha'] = $this->empresaSenha;
		 $data['sCepOrigem'] = $this->cepOrigem;
		 $data['sCepDestino'] = $this->cepDestino;
		 $data['nVlPeso'] = $this->peso;
		 $data['nCdFormato'] = $this->formato;
		 $data['nVlComprimento'] = $this->comprimento;
		 $data['nVlAltura'] = $this->altura;
		 $data['nVlLargura'] = $this->largura;
		 $data['nVlDiametro'] = $this->diametro;
		 $data['sCdMaoPropria'] = $this->maoPropria;
		 $data['nVlValorDeclarado'] = $this->valor;
		 $data['sCdAvisoRecebimento'] = $this->avisoRecebimento;
		 $data['StrRetorno'] = 'xml';
		 $servicos = array();
		 if ( $this->pacRetorno )
			$servicos[] = "41106";
		 if ( $this->sedexRetorno )
			$servicos[] = "40010";
		 if ( $this->eSedexRetorno )
			$servicos[] = "81019";
		 $data['nCdServico'] = implode(',', $servicos);
		 $data = http_build_query($data);
		 $url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';
		 $curl = curl_init($url . '?' . $data);
		 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		 $result = curl_exec($curl);
		 $result = simplexml_load_string($result);
		 $erros=array();
		 foreach($result -> cServico as $row)
		 {
			$cod = $row->Codigo;		 
			if($row->Erro == 0){
			
				if ( $cod == 41106 ){
 					$this->resultadoPac = str_replace(",",".",$row->Valor);
 					$this->resultadoPacEntrega = $row->PrazoEntrega;
				}
				if ( $cod == 40010 ){
 					$this->resultadoSedex = str_replace(",",".",$row->Valor);
 					$this->resultadoSedexEntrega = $row->PrazoEntrega;
				}
				if ( $cod == 81019 ){
 					$this->resultadoESedex = str_replace(",",".",$row->Valor);
 					$this->resultadoESedexEntrega = $row->PrazoEntrega;
				}
				
			}
			else{
				if ( $cod == 41106 )
 					$erroTipo = "PAC";
				if ( $cod == 40010 )
 					$erroTipo = "SEDEX";
				if ( $cod == 81019 )
 					$erroTipo = "E-SEDEX";
				
				$erros[] = "[$erroTipo]:" . $row->MsgErro;
			}
		 }
		 
		 $this->erro = implode(",",$erros);
	 
	 }
 
 }
 
 ?>