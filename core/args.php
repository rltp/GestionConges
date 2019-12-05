<?php
     $args = array(
        "lastname" => 
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^.{2,}$/"),
                "error" => "Le prenom doit contenir 2 caractères minimums"
            ),
        "firstname" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^.{2,}$/"),
                "error" => "Le nom doit contenir 2 caractères minimums"
            ),
        "message" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^.{2,}$/"),
                "error" => "Le message doit contenir 2 caractères minimums"
            ),
        "email" => array(
                "filter" => FILTER_VALIDATE_EMAIL,
                "error" => "L'e-mail est mal noté"
            ),
        "phone" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(?:0)\s*[1-9](?:[\s.-]*\d{2}){4}$/"),
                "error" => "Le numero doitcommencer par 0 et avoir une longeur de 10 chiffres"
            ),
        "function" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(E|P)$/"),
                "error" => "La fonction ne doit pas etre autre que les deux options"
            ),
        "contract" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(CDD|CDI)$/"),
                "error" => "Le contrat ne doit pas etre autre que les deux options"
            ),
        "date" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^([0-2][0-9]|(3)[0-1])(\-)(((0)[0-9])|((1)[0-2]))(\-)\d{4}$/"),
                "error" => "La  date d'embauche doit être sous forme aaaa-mm-jj"
            ),
        "RTT" => array(
            "filter" => FILTER_VALIDATE_REGEXP,
            "options"=> array("regexp"=>"/^(?:[1-9]|0[1-9]|10)$/"),
            "error" => "Les RTT doivent être des valeurs numeriques compris entre 0 et 10"
        ),
        "CP" => 
            array(
            "filter" => FILTER_VALIDATE_REGEXP,
            "options"=> array("regexp"=>"/^\d{1}$|^[1]{1}\d{1}$|^[2]{1}[0-4]{1}$/"),
            "error" => "Les congés payés doivent être des valeurs numeriques compris entre 0 et 24"
            ),
        "address" => 
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^\d(....)+[,]+\s+\w+[,]+\s+\d+\s+(?:rue?|ave(?:nue)?|chemin?|dr(?:\.|eef)?|boul(?:\.|evard)?)+(\s+[A-Za-z]{2,})+$/"),
                "error" => "L'adresse doit être présenté selon : CP, Ville, rue"
            ),
        "nationality" => 
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^.{4,}$/"),
                "error" => "La nationalité doit contenir 4 caractères minimums"
            ),
        "sexe" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(female|male|none)$/"),
                "error" => "Le genre ne doit pas etre autre que les trois options"
            ),
        "situation" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(alone|married|concubinage)$/"),
                "error" => "La situation familiale ne doit pas etre autre que les trois options"
            ),
        "birthday" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^([0-2][0-9]|(3)[0-1])(\-)(((0)[0-9])|((1)[0-2]))(\-)\d{4}$/"),
                "error" => "La  date de naissance doit être sous forme jj-mm-aaaa"
            ),
        "toID" => 
            array(
            "filter" => FILTER_VALIDATE_INT,
            "error" => "ID non valide"
            ),
        "status" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(2|1)$/"),
                "error" => "Le status ne doit pas etre autre que les deux options"
            ),
        "typeConge" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^(RTT|CP)$/"),
                "error" => "Le type de congé ne doit pas etre autre que les deux options"
            ),
        "startDay" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^([0-2][0-9]|(3)[0-1])(\-)(((0)[0-9])|((1)[0-2]))(\-)\d{4}$/"),
                "error" => "La  date du debut de congé doit être sous forme aaaa-mm-jj"
            ),
        "endDay" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^([0-2][0-9]|(3)[0-1])(\-)(((0)[0-9])|((1)[0-2]))(\-)\d{4}$/"),
                "error" => "La  date de fin de congé doit être sous forme aaaa-mm-jj"
            ),
        "password" =>
            array(
                "filter" => FILTER_VALIDATE_REGEXP,
                "options"=> array("regexp"=>"/^[A-Z]+.{6,}[0-9]$/"),
                "error" => "Le mot de passe doit comencer par une majuscule, et terminer par un chiffre"
            )
    );
?>