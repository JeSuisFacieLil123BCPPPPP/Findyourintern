
/*export default {
  data() {
    return {
      dates: [],
      telephones: [],
      typeEmail: [],
      messageEmail: [],
      email1: "",
      nbrJrs: ["7 jours", "10 jours", "14 jours", "22 jours"],
      e1: this.myE1(this.$route.query.step),*/
      let offre= {
        //telephoneNum: null,
        title: {
          value: "",
          //required: true,
          valide:(v)=>{
            this.valideBasic(v);
          }
        },
        type: {
          value: "",
          required: true,
        },
        lieu: {
          value: "",
          required: true,
        },
        secteur: {
          value: "",
          required: true,
        },
        description: {
          value: "",
          required: true,
        },
        exigences: {
          value: "",
          required: false,
        },
        auto_convers: {
          value: false,
          required: true,
        },
        autoriseMail: {
          value: false,
          required: true,
        },
        isSwitched: {
          value: false,
          required: true,
        },
        zone: {
          value: "",
          required: "",
        },
        date_limite: {
          value: null,
          //required: false,
          type: "date",
          valide: (v)=>{
          
          }
        },
        date_deb: {
          value: null,
          required: false,
          type: "date",
        },
        nbr: {
          value: 1,
          required: false,
        },
        duree: {
          value: {
            nbrTime: 0,
            time: "Jour(s)",
          },
          required: false,
        },
        salaire: {
          value: {
            devise: "",
            montant: "",
            frequence: "par jour",
          },
          required: false,
        },
        //salaire:
        horaires: [],
        urgence: 1,
        urgence: {
          value: 1,
          required: true,
        },
        emails: {
          value: {},
          required: false,
        },
        telephone: {},
      };
      let   type ={
        title: "",
        lieu: "",
        type: "",
        zone: "",
        secteur: "",
        description: "",
        exigences: "",
        date_limite: "",
        date_deb: "",
        type: "",
        nbr: "",
        duree: "",
        salaire: "",
        horaire: "",
        urgence: "",
      };
      let message= {
        step1: {
          title: "",
          lieu: "",
          zone: "",
          secteur: "",
        },
        step2: {
          description: "",
          exigences: "",
        },
        step3: {
          date_limite: "",
          date_deb: "",
          type: "",
          duree: "",
          salaire: "",
          horaire: "",
          urgence: "",
        },
      };
    /*  modelOffre: {
        title: "",
        type: "",
        lieu: "",
        secteur: "",
        description: "",
        exigences: "",
        auto_convers: false,
        autoriseMail: false,
        exigences: "",
        zone: "",
        date_limite: "",
        date_deb: "",
        nbr: 1,
        duree: {
          nbrTime: 0,
          time: "Jour(s)",
        },
        salaire: {
          devise: "",
          montant: "",
          frequence: "par jour",
        },
        horaires: [],
        urgence: 1,
        emails: {},
      },
      message: {
        step1: {
          title: "",
          lieu: "",
          zone: "",
          secteur: "",
        },
        step2: {
          description: "",
          exigences: "",
        },
        step3: {
          date_limite: "",
          date_deb: "",
          type: "",
          duree: "",
          salaire: "",
          horaire: "",
          urgence: "",
        },
      },
      type: {
        title: "",
        lieu: "",
        type: "",
        zone: "",
        secteur: "",
        //fonction: "",
        //responsabilite: "",
        description: "",
        exigences: "",

        // disponiblite: "",
        date_limite: "",
        date_deb: "",
        type: "",
        nbr: "",
        // frequence: "",
        // nbrfrequence: "",
        duree: "",
        salaire: "",
        horaire: "",
        urgence: "",
      },*/
     /* messageTitle: "",
      typeTitle: "",
    */

