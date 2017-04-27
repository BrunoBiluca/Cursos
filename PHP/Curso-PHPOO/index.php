<?php
	//Mostra todos os arquivos e pastas dentro deste diretorio

   $path = "./";
   if(isset($_GET['caminho'])){
	   $path .= $_GET['caminho'];
   }
   $diretorio = dir($path);
    
    echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";    
   while($arquivo = $diretorio -> read()){
	  if(strpos($arquivo, '.php') !== false){
		echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
	  }else{
		echo "<a href='?caminho=".$path.$arquivo."/'>".$arquivo."</a><br />";
	  }
   }
   $diretorio -> close();
?>