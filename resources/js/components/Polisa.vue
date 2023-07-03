<template>

    <div class="container">
    
        <div class="row justify-content-center">

            <h2 class="m-3">Polisa osiguranja</h2>
                <form class="border p-4 rounded" method="GET">
                    <div class="row">
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Ime</label>
                        <input required type="text" class="form-control" name="ime" placeholder="Unesite ime" v-model="ime" :class="{ 'is-invalid': greske.ime }">
                        <span v-if="greske.ime" class="invalid-feedback">Molimo Vas unesite ime.</span>
                        </div>
                        
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Prezime</label>
                        <input required type="text" class="form-control" name="prezime" placeholder="Unesite prezime" v-model="prezime" :class="{ 'is-invalid': greske.prezime }">
                        <span v-if="greske.ime" class="invalid-feedback">Molimo Vas unesite prezime.</span>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3 mt-3">
                            <label for="inputState">Datum rodjenja</label> <br>
                            <date-picker v-model="datumRodjenja" name="datumRodjenja" type="date" :format="dateFormat" :class="{ 'is-invalid': greske.datumRodjenja }"></date-picker><br>
                            <span v-if="greske.datumRodjenja" class="invalid-feedback">Molimo Vas unesite datum rodjenja.</span>
                        </div>
                        <div class="col mb-3 mt-3">
                            <label for="inputState">Telefon</label>
                            <input required type="text" class="form-control" name="tel" placeholder="Unesite broj telefona" v-model="telefon" :class="{ 'is-invalid': greske.telefon }">
                            <span v-if="greske.telefon" class="invalid-feedback">Molimo Vas unesite broj telefona.</span>

                        </div>
                    </div>


                    <div class="form-group mb-3">
                        <label for="inputState">Vrsta osiguranja</label>

                        <select id="inputState"  name="osiguranje" class="form-control" v-model="selectedOption" :class="{ 'is-invalid': greske.selectedOption }">
                            <!-- <option  v-for="item in data">{{ item.vrstaPolise }}</option> -->
                            <option>individualno</option>
                            <option>grupno</option>
                        </select>
                        <span v-if="greske.selectedOption" class="invalid-feedback">Molimo Vas izaberite vrstu osiguranja.</span>
                    </div>


                    <div class="form-group">
                        <div class="row">
                            <div class="col mb-3 mt-3">
                            <label for="inputState">Od</label>
                            <date-picker v-model="time1" type="date"  name="datumOd" :format="dateFormat" :class="{ 'is-invalid': greske.time1 }"></date-picker><br>
                            <span v-if="greske.time1" class="invalid-feedback">Molimo Vas izaberite datum.</span>
                            </div>
                            <div class="col mb-3 mt-3">
                            <label for="inputState">Do</label>
                            <date-picker v-model="time2" type="date" name="datumDo" :format="dateFormat" :class="{ 'is-invalid': greske.time2 }"> </date-picker><br>
                            <span v-if="greske.time2" class="invalid-feedback">Molimo Vas izaberite datum.</span>
                            </div>
                        </div>
                    </div>  

                    <label class="col mb-3 mt-3" v-if="ukupnoDani()>=0">Izabrali ste da na putovanju provedete {{ ukupnoDani() }} dana </label>
                    <label class="col mb-3 mt-3 text-danger" v-if="izborDatuma"><b>Nepravilan izbor datuma</b></label>

                    <div class="row">
                        <div class="card mb-3 mt-3" v-if="selectedOption === 'grupno'" style="width: 18rem;">
                            <div class="card-body p-3">
                                <h3>Osiguranik</h3>
                                <label class="p-1">Ime</label> <input required :class="{ 'is-invalid': greskeOsiguranik.imeOsiguranika }" type="text" class="form-control" v-model="imeOsiguranika" name="imeO" placeholder="Unesite ime">
                                <span v-if="greskeOsiguranik.imeOsiguranika" class="invalid-feedback">Molimo Vas unesite ime.</span>
                                <label class="p-1">Prezime</label> <input required :class="{ 'is-invalid': greskeOsiguranik.prezimeOsiguranika }" type="text" class="form-control" v-model="prezimeOsiguranika" name="prezimeO" placeholder="Unesite prezime">
                                <span v-if="greskeOsiguranik.prezimeOsiguranika" class="invalid-feedback">Molimo Vas unesite prezime.</span>
                                <label class="p-1" for="inputState">Datum rodjenja</label> <br>
                                <date-picker v-model="datumRodjenjaOsiguranika" type="date" name="datumO" :format="dateFormat" :class="{ 'is-invalid': greskeOsiguranik.datumRodjenjaOsiguranika }"></date-picker>
                                <span v-if="greskeOsiguranik.datumRodjenjaOsiguranika" class="invalid-feedback">Molimo Vas unesite datum rodjenja.</span>

                            </div>

                            <div class="card-body">
                                <button type="button" class="btn btn-primary m-1" @click="dodajNaListu">Dodaj osiguranika</button>
                            </div>
                        </div>


                        <ul class="list-group list-group-flush  m-2" style="width:fit-content;">
                            <li class="list-group-item" v-if="kreirajOsiguranika()" v-for="(osiguranikItem, index) in lista" style="width:fit-content;">{{ osiguranikItem.imeO }} {{ osiguranikItem.prezimeO }} - {{ osiguranikItem.datumO }} <input type="button" @click="obrisi(index)" value="Ukloni"></li>
                        </ul> 

                    </div>

                    <div>
                        <button id="dugme" type="button" class="btn btn-success m-1" @click="dodajPolisu">Zavrsi kupovinu</button>
                    </div>
                </form>

        </div>
    </div>
</template>

<script>
var csrfToken = $('meta[name="csrf-token"]').attr('content');
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import moment from 'moment';
import Swal from 'sweetalert2';
import zaglavlje from './Zaglavlje.vue';
import axios from "axios";
import $ from "jquery";

export default {
    components: {
        DatePicker,
        
    },
    props: {
        // data: {
        // },
    },
    data() {
        return {
            lista:[],
            // osiguranikItem:'',
            ime:'',
            prezime:'',
            telefon:'',
            imeOsiguranika: '',
            prezimeOsiguranika: '',
            selectedOption: 'individualno',
            datumRodjenja:'',
            datumRodjenjaOsiguranika:'',
            time1: '',
            time2: '',
            dateFormat : 'DD.MM.YYYY',
            izborDatuma: false,
            greske: {},
            greskeOsiguranik: {}
        }
    },
    methods:{
        ukupnoDani(){
            let ukupno = '';
            let datumOd = moment(this.time1);
            let datumDo = moment(this.time2);

            if(datumDo >= datumOd){
            let razlika = datumDo.diff(datumOd);
            razlika = moment.duration(razlika);
            this.izborDatuma = false;
            return ukupno += razlika.days()+1;
            }
            else if(this.time1 != '' && this.time2 != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Datum povratka ne moze biti manji od datuma putovanja!',
                })
                this.time2 = '';
                this.izborDatuma = true;
                // alert("Datum povratka ne moze biti manji od datuma putovanja!");
                return ukupno = '';
            }
        },
        kreirajOsiguranika(){
            return this.selectedOption === 'grupno';
        },
        dodajNaListu() {

            if(this.imeOsiguranika === '' || this.prezimeOsiguranika === '' || this.datumRodjenjaOsiguranika === ''){
                this.greskeOsiguranik = {
                    imeOsiguranika: this.imeOsiguranika === '',
                    prezimeOsiguranika: this.prezimeOsiguranika === '',
                    datumRodjenjaOsiguranika: this.datumRodjenjaOsiguranika === '',
                };
               
            }

            // if (!this.datumRodjenjaOsiguranika) {
            //     this.greskeOsiguranik.datumRodjenjaOsiguranika = true;
            //     return;
            // }
            // this.greskeOsiguranik.datumRodjenjaOsiguranika = false;
            // // this.greskeOsiguranik = {};

            if(this.imeOsiguranika === '' || this.prezimeOsiguranika === '' || this.datumRodjenjaOsiguranika === ''){
                Swal.fire({
                    icon: 'warning',
                    title: 'Molimo Vas popunite sve podatke o osiguraniku.',
                })
                return;
               
            }
           
            const groupUserItem = {
                imeO: this.imeOsiguranika,
                prezimeO: this.prezimeOsiguranika,
                datumO: moment(this.datumRodjenjaOsiguranika).format('DD.MM.YYYY'),
            };

            this.lista.push(groupUserItem);

            this.imeOsiguranika = ''; 
            this.prezimeOsiguranika = '';
            this.datumRodjenjaOsiguranika = '';

            this.greskeOsiguranik = {};
        },
        obrisi(index){
            this.lista.splice(index, 1);
        },
        dodajPolisu() {
            if (this.ime === '' || this.prezime === '' || this.telefon === '' || this.selectedOption === '' || this.datumRodjenja === '' || this.time1 === '' || this.time2 === '') 
            { 
                this.greske = {
                    ime: this.ime === '',
                    prezime: this.prezime === '',
                    telefon: this.telefon === '',
                    selectedOption: this.selectedOption === '',
                    datumRodjenja: this.datumRodjenja === '',
                    time1: this.time1 === '',
                    time2: this.time2 === '',
                };
            }


            if ( this.ime === '' || this.prezime === '' || this.telefon === '' || this.selectedOption === '' || this.datumRodjenja === '' || this.time1 === '' || this.time2 === ''){
                Swal.fire({
                    icon: 'warning',
                    title: 'Morate popuniti sva polja!',
                })
                return;
            }


            this.greske = {};


            if (this.selectedOption==='grupno' && this.lista.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Greska!',
                    text: 'Lista osiguranika ne sme biti prazna!',
                })
                    return;
            }

            const polisaData = {
                ime: this.ime,
                prezime: this.prezime,
                datum: this.datumRodjenja,
                telefon: this.telefon,
                datumOd: this.time1,
                datumDo: this.time2,
                vrstaPolise: this.selectedOption,
            };

            const osiguranici = this.lista.map(item => {
                return {
                    imeO: item.imeO,
                    prezimeO: item.prezimeO,
                    datumO: moment(item.datumO, 'DD.MM.YYYY').format('YYYY-MM-DD'),
                };
            });

            axios.post('/osiguranje/dodajPolisu', { polisaData, osiguranici }, {
                    headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    },
                })
                .then(response => {
                    console.log(response.data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Uspesna kupovina!',
                    });
                    this.ime = '';
                    this.prezime = '';
                    this.datumRodjenja = '';
                    this.telefon = '';
                    this.time1 = '';
                    this.time2 = '';
                    this.selectedOption = 'individualno';
                    this.lista = [];

                }).catch(error => {
                    // Handle any errors
                    console.error(error);
                });
        },

    // // mounted() {
        
    // // }

    }
  
}
</script>
