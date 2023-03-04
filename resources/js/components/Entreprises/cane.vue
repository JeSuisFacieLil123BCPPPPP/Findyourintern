<template>
  <b-field
    class="mt-1"
    :message="messageEmail['candidatureEmails'][index]"
    :type="typeEmail['candidatureEmails'][index]"
    expended
  >
    <b-input
      :key="index"
      expended
      :ref="index"
      type="email"
      :value="value"
      @input="valideEmails($event, 'candidatureEmails', index)"
    >
    </b-input>

    <p class="">
      <vs-button
        @click="removeInputEmail('candidatureEmails', index)"
        class="h-100"
        color="danger"
        type="border"
        icon="delete"
      ></vs-button>
    </p>
  </b-field>
</template>
<script>
export default {
  data() {
    return {};
  },
  methods: {
    getAllTelephones() {
      fetch("https://restcountries.com/v3.1/all")
        .then((response) => response.json())
        .then((data) => {
          console.log("telephones");
          console.log(data);
          this.telephones = data;
        })
        .catch((error) => console.error(error));
    },
    getSelectedPhone() {
      fetch("https://restcountries.com/v3.1/name/benin")
        .then((response) => response.json())
        .then((data) => {
          console.log("data loading2");
          console.log(data);
          this.telephone = data[0];
        })
        .catch((error) => console.error(error));
      let tel = this.telephone;
      this.telephone = this.offre.telephone ? this.offre.telephone : tel;
      this.telephoneNum = this.offre.telephoneNum;
      console.log("final");
      console.log(this.telephones);
      console.log(this.emails);
    },
  },
  beforeMount() {
    // this.removeAll();
    this.getAllTelephones();
    this.getSelectedPhone();
    this.offre = this.offreStocke;
    this.telephone = this.offre.telephone ? this.offre.telephone : this.telephone;
    this.telephoneNum = this.offre.telephoneNum
      ? this.offre.telephoneNum
      : this.telephoneNum;
    this.isSwitched = this.offre.isSwitched ? this.offre.isSwitched : this.isSwitched;
    this.radio2 = this.offre.auto_convers ? this.offre.auto_convers : this.radio;
    this.reject = this.offre.reject ? this.offre.reject : this.reject;
    if (Object.keys(this.emails).length == 0) {
      this.addEmail({ email: this.user.email, userId: this.user.id });
      this.emails = this.theEmails;
    }
    /* if (
        field == "duree" &&
        this.offre[field].value.nbrTime &&
        this.offre[field].value.nbrTime != 0 &&
        this.offre[field].value.nbrTime.length != 0
      ) {
        this.verifNumber(step, "duree", this.offre.duree.value.nbrTime);
      }
      if (
        field == "nbr" &&
        this.offre.nbr.value &&
        this.offre.nbr.value != 0 &&
        this.offre.nbr.value.length != 0
      ) {
        console.log("this.offre.nbr.value.toString().length");
        console.log(this.offre.nbr.value.toString().length);

        this.verifNumber(step, "nbr", this.offre.nbr.value);
      }
      if (
        field == "salaire" &&
        this.offre.salaire.value.montant &&
        this.offre.salaire.value.montant != 0 &&
        this.offre.salaire.value.montant.length != 0
      ) {
        console.log("this.offre.salaire.value.montant.toString().length");
        console.log(this.offre.salaire.value.montant.toString().length);
        this.verifNumber(step, "nbr", this.offre.salaire.value.montant);
      }*/
  },
  /* verifNumber(step, field, value) {
      if (field == "duree") this.offre.duree.value.nbrTime = value;
      if (field == "salaire") this.offre.salaire.value.montant = value;
      if (/^\d+$/.test(value)) {
        this.type[field] = "is-success";
        this.message[step][field] = "";
        this.removeError(field);
      } else {
        this.type[field] = "is-danger";
        this.message[step][field] = "Vous devez entrer un nombre";
      }
    },
       /* chipClick(tag) {
      tag.checked = !tag.checked;
      console.log(tag);
      console.log(this.horaires);
      console.log(this.offre.horaires.value);
      this.offre.horaires.value = this.horaires;
      *if (tag.checked == true) {
        this.offre.horaires.value.push(tag);
        //talent
      } else if (tag.checked == false) {
        //  var index = this.offre.horaires.value.indexOf(tag);
        var index = this.offre.horaires.value.findIndex((val) => {
          return (val.id = tag.id);
        });
        if (index > -1) {
          this.offre.horaires.value.splice(index, 1);
        }
      }
      this.change = !this.change;
      console.log("horaires.value");
      console.log(this.offre.horaires.value);*
      this.valide(this.offre.horaires.value, "step3", "horaires");
    },
     getHoraire() {
      /* const mergedArray = [...this.horaires, ...this.offre.horaires.value];
      const mergedObject = mergedArray.reduce((result, obj) => {
        result[obj.id] = Object.assign(result[obj.id] || {}, obj);
        return result;
      }, {});

      return Object.values(mergedObject);*
      // return this.horaires; //this.horaires.concat(this.offre.horaires.value);
    },*/
    */
    */
  valideDuree() {
    if (this.offre.duree.nbrTime.length != 0 || this.offre.duree.time.length != 0) {
      if (this.offre.duree.nbrTime.length == 0) {
        this.type.duree = "is-danger";
        this.message.step3.duree =
          "Veuillez renseigner le nombre de" + this.offre.duree.time;
      } else if (this.offre.duree.time.length == 0) {
        this.type.duree = "is-danger";
        this.message.step3.duree = "Veuillez renseigner le temps";
      }
    } else if (
      this.offre.duree.nbrTime.length != 0 &&
      this.offre.duree.time.length != 0
    ) {
      this.type.type = "is-success";
      this.message.step3.duree = "";
      this.removeError("duree");
    } else if (
      this.offre.duree.nbrTime.length == 0 &&
      this.offre.duree.time.length == 0
    ) {
      this.type.type = "";
      this.message.step3.duree = "";
      this.removeError("duree");
    }
  },
};
</script>
