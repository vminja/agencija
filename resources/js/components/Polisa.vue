<template>
    <div class="container">
        <div class="row justify-content-center">

            <h2>Polisa osiguranja</h2>
            <form class="border p-4 rounded" method="GET" action="/osiguranje">
                    <div class="row">
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Ime</label>
                        <input required type="text" class="form-control" placeholder="Unesite ime" v-model="ime">
                        </div>
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Prezime</label>
                        <input required type="text" class="form-control" placeholder="Unesite prezime" v-model="prezime">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3 mt-3">
                            <label for="inputState">Datum rodjenja</label> <br>
                            <date-picker v-model="datumRodjenja" type="date" :format="dateFormat"></date-picker>
                        </div>
                        <div class="col mb-3 mt-3">
                            <label for="inputState">Telefon</label>
                            <input required type="text" class="form-control" placeholder="Unesite broj telefona" v-model="telefon">
                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="inputState">Vrsta osiguranja</label>

                        <select id="inputState" class="form-control" v-model="selectedOption">
                            <option  v-for="item in data">{{ item.vrstaPolise }}</option>
                            
                        </select>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col mb-3 mt-3">
                            <label for="inputState">Od</label>
                            <date-picker v-model="time1" type="date" :format="dateFormat"></date-picker>
                            </div>
                            <div class="col mb-3 mt-3">
                            <label for="inputState">Do</label>
                            <date-picker v-model="time2" type="date" :format="dateFormat"> </date-picker>
                            </div>
                        </div>
                    </div>  

                    <label class="col mb-3 mt-3" v-if="ukupnoDani()>=0">{{ ukupnoDani() }}</label>
                    <label class="col mb-3 mt-3 text-danger" v-else><b>Nepravilan izbor datuma</b></label>

                    <div class="row">
                        <div class="card mb-3 mt-3" v-if="kreirajOsiguranika()" style="width: 18rem;">
                            <div class="card-body p-3">
                                <h3>Osiguranik</h3>
                                <label class="p-1">Ime</label> <input required type="text" class="form-control" v-model="imeOsiguranika" name="ime" placeholder="Unesite ime">
                                <label class="p-1">Prezime</label> <input required type="text" class="form-control" v-model="prezimeOsiguranika" name="prezime" placeholder="Unesite prezime">
                                <label class="p-1" for="inputState">Datum rodjenja</label> <br>
                                <date-picker v-model="datumRodjenjaOsiguranika" type="date" :format="dateFormat"></date-picker>
                            </div>

                            <div class="card-body">
                                <button class="btn btn-primary m-1" @click="dodajNaListu">Dodaj osiguranika</button>
                            </div>
                        </div>


                        <ul class="list-group list-group-flush  m-2" style="width:fit-content;">
                            <li class="list-group-item" v-if="kreirajOsiguranika()"  v-for="osiguranikItem in lista" style="width:fit-content;">{{ osiguranikItem }}</li>
                        </ul>

                    </div>

                    <div>
                        <button id="dugme" type="submit" class="btn btn-success m-1" @click="dodajPolisu">Sacuvaj</button>
                    </div>
                </form>

                <!-- 
                    Sve spojiti u istu metodu pa iz jedne slati u bazu 
                    insertgetbyid
                    iz liste treba da se citaju podaci
                    uraditi provere ako je sve popunjeno tek onda da se dodaje
                    i da se ne azurira stranica u toku popunjavanja liste vec samo kad se sacuva polisa

                 -->


        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment';

export default {
    components: {
        DatePicker,
        
    },
    props: {
        data: {
        },
    },
    data() {
        return {
            lista:[],
            osiguranikItem:'',
            ime:'',
            prezime:'',
            telefon:'',
            imeOsiguranika: '',
            prezimeOsiguranika: '',
            selectedOption: '',
            datumRodjenja:'',
            datumRodjenjaOsiguranika:'',
            time1: '',
            time2: '',
            dateFormat : 'DD.MM.YYYY',
        }
    },
    methods:{
        ukupnoDani(){
            let ukupno = "";
            let datumOd = moment(this.time1);
            let datumDo = moment(this.time2);

            if(datumDo >= datumOd){
            let razlika = datumDo.diff(datumOd);
            razlika = moment.duration(razlika);

            return ukupno += razlika.days();
            }
            else if(this.time1 != '' && this.time2 != '') {
                this.time1 = '';
                this.time2 = '';
                alert("Datum povratka ne moze biti manji od datuma putovanja!");
                return ukupno = "";
            }

        },
        kreirajOsiguranika(){
            return this.selectedOption === 'grupno';
        },
        dodajNaListu(){
            let x = moment(this.datumRodjenjaOsiguranika).format('DD.MM.YYYY');
            this.osiguranikItem = this.imeOsiguranika + ' ' + this.prezimeOsiguranika + '-' + x;
            this.lista.push(this.osiguranikItem);
        },
        dodajPolisu(){
            const formData = {
                ime: this.ime,
                prezime: this.prezime,
                datum: this.datumRodjenja,
                telefon: this.telefon,
                datumOd: this.time1,
                datumDo: this.time2,
                vrstaPolise: this.selectedOption,

                osiguranik: this.lista,
            };

            axios.post('/osiguranje/dodajPolisu', formData)
                .then(response => {
                // Handle the response from the Laravel controller
                console.log(response.data);
                })
                .catch(error => {
                // Handle any errors
                console.error(error);
                });

        },
        // handleSubmit() {
        //     const formData = {
        //         ime: this.imeOsiguranika,
        //         prezime: this.prezimeOsiguranika,
        //         datum: this.datumRodjenjaOsiguranika,
        //     };

        //     axios.get('/osiguranje/dodajOsiguranika', formData)
        //         .then(response => {
        //         // Handle the response from the Laravel controller
        //         console.log(response.data);
        //         //dodaj metodu za prikaz u tabeli
        //         })
        //         .catch(error => {
        //         // Handle any errors
        //         console.error(error);
        //         });
        // },

    // mounted() {
    //     this.ukupnoDani();
    // }

    }
  
}
</script>
