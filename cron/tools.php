<?php

function parseHTML($HTML, $expression) {
  $result = array();
  preg_match_all('/' . $expression . '/im', $HTML, $result);
  return $result;
}

function parseHTML_si($HTML, $expression) {
  $result = array();
  preg_match_all('/' . $expression . '/si', $HTML, $result);
  return $result;
}

/**
 * Permet de cropper une image au format png/jpg et gif au format souhaité
 *
 * Si la largeur ou la hauteur est mise à 0 la dimension sera automatiquement calculé
 * de manière à garder le ratio de l'image
 *
 * @param string $img Fichier image d'origine (doit avoir une extension)
 * @param string $dest Fichier de destination (avec l'extension .jpg)
 * @param integer $largeur Largeur de l'image en sortie
 * @param integer $hauteur Hauteur de l'image en sortie
 */
function crop($img,$dest,$largeur=0,$hauteur=0,$qualite=100){
        $dimension=getimagesize($img);
        $ratio = $dimension[0] / $dimension[1];
        // Création des miniatures
        if($largeur==0 && $hauteur==0){ $largeur = $dimension[0]; $hauteur = $dimension[1]; }
          else if($hauteur==0){ $hauteur = round($largeur / $ratio); }
        else if($largeur==0){ $largeur = round($hauteur * $ratio); }
  
        if($dimension[0]>($largeur/$hauteur)*$dimension[1] ){ $dimY=$hauteur; $dimX=round($hauteur*$dimension[0]/$dimension[1]); $decalX=($dimX-$largeur)/2; $decalY=0;}
        if($dimension[0]<($largeur/$hauteur)*$dimension[1]){ $dimX=$largeur; $dimY=round($largeur*$dimension[1]/$dimension[0]); $decalY=($dimY-$hauteur)/2; $decalX=0;}
        if($dimension[0]==($largeur/$hauteur)*$dimension[1]){ $dimX=$largeur; $dimY=$hauteur; $decalX=0; $decalY=0;}
        $miniature =imagecreatetruecolor ($largeur,$hauteur - 39);
        $ext = end(explode('.',$img));
        if(in_array($ext,array('jpeg','jpg','JPG','JPEG'))){$image = imagecreatefromjpeg($img); }
        elseif(in_array($ext,array('png','PNG'))){$image = imagecreatefrompng($img); }
        elseif(in_array($ext,array('gif','GIF'))){$image = imagecreatefromgif($img); }
        else{ return false; }
        imagecopyresampled($miniature,$image,-$decalX,-$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
        imagejpeg($miniature,$dest,$qualite);
          
        return true;
}

function slug($str, $replace=array(), $delimiter='-') {
	$replace = array_merge($replace, array('*', '`', "'", "/"));
	$str = str_replace((array)$replace, ' ', $str);
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}