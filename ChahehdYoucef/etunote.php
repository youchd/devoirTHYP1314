<?php
include_once 'Personne.php';

// lecture d'un flux RSS 
$handle = fopen("http://picasaweb.google.com/data/feed/base/user/112537161896190034287/albumid/5931538032377292977?alt=rss&kind=photo&authkey=Gv1sRgCJjJwc265LnxigE&hl=fr", "rb");

// buffer contenant les données du flux
$flux = '';

// si la lecture du flux RSS est ok
if (isset($handle) && !empty($handle)) {
    while (!feof($handle)) {
		
    // on charge les données de notre flux RSS par paquet
    $flux .= fread($handle, 4096);
    }

    // test avec la classe SimpleXML
    // on construit notre parser RSS avec notre flux RSS
    $RSS2Parser = simplexml_load_string($flux);

    // on se positionne sur la balise (racine de notre flux RSS)
    $racine = $RSS2Parser->channel;

    // pour chaque item
    foreach($racine ->item as $element) {
        
        /*var_dump($element->description);
        die();*/
        
        //retourne la position de la chaine en paramètre dans une chaine
        $linkPosition = stripos($element->description, "src");
        
        //couper la chaine de caractère à partir de la position indiqué
        $link = substr($element->description, $linkPosition);
        
        //on les découpe selon notre ...
        $trueLink = explode('</a>', $link);
		$desc = utf8_decode((string)$element->title);
        $personne[] = new Personne($trueLink[0],$desc);
    } 

    
    /*echo "<h2>Liste des étudiants participants</h2>";
    var_dump($personne);
    die();*/
}
?>
<hr/>
<h2>Liste des étudiants participants</h2><a href="#" id="hideBlock"><img src="hide.png"></a>
<hr/>
<?php 
         
  foreach($personne as $p){ ?>
    <div class="photo">
        <img <?php $tab=array(); $tab = explode(" ",$p->nom);
		echo $p->img;?> 
 <br>
 
	
	</div>	
        <p> Nom :<?php echo $tab[0];?></p>
        <p> Prenom :<?php if(sizeof($tab)>1){ echo $tab[1]; } else{ echo " ";  }       ?></p>
		</br>
        <div class="diagramme">
            <p id="headBlock">
            
            
        </div>

    </div>

    <hr/>
<?php }
?>


 
 <script>
 
     function setPrescence(lib,cr) {

$.ajax({
type: "POST",
url: "prescence.php",
data: {data:lib,cours:cr},
success: function(msg){
alert( "Data Saved: " + msg );
}
});
}
//Call AJAX:
$(document).ready(setPrescence(lib));


</script> 
 <script type="text/javascript">
    $(function(){

       $('#hideBlock').click(function(e){
           e.preventDefault;
           $('#studentsInfo').fadeOut(1000);
       });
    });
</script>