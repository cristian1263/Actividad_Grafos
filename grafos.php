<?php  
include("vertice.php");
class Grafos{
	private $matrizA;
	private $vectorV;
	private $dirigido;
    

public function __construct($dir=true){
	$this->matrizA=null;
	$this->vectorV=null;
	$this->dirigido=$dir;
	
}


public function AgregarVertice($v){
if(!isset($this->vectorV[$v->getId()])){
	$this->matrizA[$v->getId()] = null;
	$this->vectorV[$v->getId()] = $v;
} else{
	return false;
}
    return true;

	}

public function getVertice($v){
	return ( isset($this->vectorV[$v]))? $this->vectorV[$v] : null;
}

public function AgregarArista($o,$d,$p=null){

if (isset($this->vectorV[$o]) && isset($this->vectorV[$d])) {
	$this->matrizA[$o][$d]=$p;
} else {
return false; 
}
return true;
}
public function getAdyacentes($v){

	return $this->matrizA[$v];

}

public function getMatrizA(){
	return $this->matrizA;
}


public function getVectorV(){
	return $this->vectorV;
}

public function gradosalida($v){
	$i=0;

	return (isset($this->matrizA[$v]))? count($this->matrizA[$v]) : null;

	
}

public function gradoentrada($v){
$gr=0;
if ($this->matrizA != null) {
	foreach ($this->matrizA as $vp => $adya) {
		if ($adya != null) {
			foreach ($adya as $de => $pe) {
				if ($de==$v) {
					$gr++;
				}
			}
		}
	}
}
return $gr;
}


public function grado($v){
	return $this->gradosalida($v) + $this->gradoentrada($v);
}



public function eliminarArista($o,$d){
	if (isset($this->matrizA[$o][$d])) {
		unset($this->matrizA[$o][$d]);
	}else{
		return false;
	}
	return true;
}




public function eliminarVertice($v){
	if (isset($this->vectorV[$v])) {
		foreach ($this->matrizA as $vp => $adya) {
			if ($adya != null) {
				foreach ($adya as $de => $pe) {
					if ($de==$v) {
					  unset($this->matrizA[$vp][$de]);
					}
				}
			}
		}
		unset($this->matrizA[$v]);
		unset($this->vectorV[$v]);

	}else{
     return false;
     }
     return true;
}




}



?>