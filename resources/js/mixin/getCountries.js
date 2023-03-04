export default {
    data() {
        return {
            selectedCountry: null,
            countries: null,
        }
    },
    methods: {
        async getAllCountries() {
            fetch("https://restcountries.com/v3.1/all")
              .then((response) => response.json())
              .then((data) => {
                console.log("pays");
                console.log(data);
                this.countries = data;
              })
              .catch((error) => console.error(error));
          },
          async getSelectedCountry(pays) {
              await axios
                .get("https://restcountries.com/v3.1/name/" +pays)
                .then((data) => {
                  console.log("data loading2");
                  console.log(data.data);
                  // this.offre.telephone = data.data[0];
                  this.selectedCountry = data.data[0];
                })
                .catch((error) => console.error(error));
          },
    }
}
