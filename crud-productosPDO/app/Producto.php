<?php
/*
  `PRODUCTO_NO` int(4) NOT NULL,
  `DESCRIPCION` varchar(30) DEFAULT NULL,
  `PRECIO_ACTUAL` float(8,2) DEFAULT NULL,
  `STOCK_DISPONIBLE` int(9) DEFAULT NULL
*/

class Producto
{
    private $PRODUCTO_NO;
    private $DESCRIPCION;
    private $PRECIO_ACTUAL;
    private $STOCK_DISPONIBLE;
        
    // Getter con método mágico
    public function __get($atributo){
      if(property_exists($this, $atributo)) {
          return $this->$atributo;
      }
  }
  // Setter con método mágico
  public function __set($atributo,$valor){
      if(property_exists($this, $atributo)) {
          $this->$atributo = $valor;
      }
  }
    
}