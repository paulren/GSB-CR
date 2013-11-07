<?php

require_once 'Framework/Modele.php';

// Services métier liés aux praticiens 
class Praticien extends Modele {

    // Morceau de requête SQL incluant les champs de la table praticien
    private $sqlPraticien = 'select id_praticien as idPraticien, P.id_type_praticien as idTypePraticien, nom_praticien as nomPraticien, prenom_praticien as prenomPraticien, adresse_praticien as adressePraticien, cp_praticien as cpPraticien, ville_praticien as villePraticien, coef_notoriete as coefNotoriete, TP.lib_type_praticien as libTypePraticien from PRATICIEN P join TYPE_PRATICIEN TP on P.id_type_praticien=TP.id_type_praticien';

    // Renvoie la liste des praticiens
    public function getPraticiens() {
        $sql = $this->sqlPraticien . ' order by nom_praticien';
        $medicaments = $this->executerRequete($sql);
        return $medicaments;
    }

    // Renvoie un praticien à partir de son identifiant
    public function getPraticien($idPraticien) {
        $sql = $this->sqlPraticien . ' where id_praticien=?';
        $praticien = $this->executerRequete($sql, array($idPraticien));
        if ($praticien->rowCount() == 1)
            return $praticien->fetch();  // Accès à la première ligne de résultat
        else
            throw new Exception("Aucun praticien ne correspond à l'identifiant '$idPraticien'");
    }

}
