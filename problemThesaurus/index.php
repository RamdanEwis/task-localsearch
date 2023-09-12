<?php
class Thesaurus
{
    private $thesaurus;


    public function __construct($thesaurus)
    {
        $this->thesaurus = $thesaurus;
    }
    
/*    function Thesaurus($thesaurus)
    {
        $this->thesaurus = $thesaurus;
    }*/

    public function getSynonyms($word)
    {
/*        $this->thesaurus =   array
        (
            "buy" => array("purchase"),
            "big" => array("great", "large")
        );*/

        if (array_key_exists($word,$this->thesaurus)) {
            return json_encode([
                "word" => $word,
                "synonyms" => $this->thesaurus[$word]]
            );
        }else{
            return json_encode([
                "word" => $word,
                "synonyms" => []
            ]);
        }

    }
}

$thesaurus = new Thesaurus(
    array
    (
        "buy" => array("purchase"),
        "big" => array("great", "large")
    ));



echo $thesaurus->getSynonyms("big");
echo "\n";
echo "\n";
echo $thesaurus->getSynonyms("agelast");