<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model\Dal\ModelDb\Stagiaire;

/**
 * Description of StagiaireObject
 *
 * @author laurent
 */
class StagiaireObject {
    public $id_stagiaire; //PrK
    public $sta_civilite_stagiaire;
    public $sta_nom_stagiaire;
    public $sta_prenom_stagiaire;
    public $sta_mel_stagiaire;
    public $sta_adresse1_stagiaire;
    public $sta_adresse2_stagiaire;
    public $sta_url_stagiaire;
    public $sta_cp_stagiaire;
    public $sta_civilite_resp_legal;
    public $sta_nom_resp_legal;
    public $sta_prenom_resp_legal;
    public $sta_mel_resp_legal;
    public $sta_adresse1_resp_legal;
    public $sta_adresse2_resp_legal;
    public $sta_url_resp_legal;
    public $sta_cp_resp_legal;
    public $sta_affiliation;
    public $id_promotion; //FrK
    public $id_enseignant; //FrK
}
