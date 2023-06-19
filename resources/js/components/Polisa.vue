<template>
    <div class="container">
        <div class="row justify-content-center">

            <h2>Polisa osiguranja</h2>
            <form class="border p-4 rounded" method="POST">
                    <div class="row">
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Ime</label>
                        <input required type="text" class="form-control" placeholder="Unesite ime">
                        </div>
                        <div class="col mb-3 mt-3">
                        <label for="inputState">Prezime</label>
                        <input required type="text" class="form-control" placeholder="Unesite prezime">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputState">Vrsta osiguranja</label>

                        <select id="inputState" class="form-control">
                 
                            <option v-for="item in data">{{ item.vrstaPolise }}</option>
                            
                        </select>
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <label for="inputState">Telefon</label>
                        <input required type="text" class="form-control" placeholder="Unesite broj telefona">
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

                    <!-- <label @change="ispisDatuma">{{ dani }}</label> -->
                    <label>{{ ukupnoDani() }}</label>
                    <div>
                        <button id="dugme" type="submit" class="btn btn-primary">Sacuvaj</button>
                    </div>
                   
                </form>

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
            time1: '',
            time2: '',
            dateFormat : 'DD.MM.YYYY'
        }
    },
    methods:{
        // formattedDate() {
        //     return moment().format('DD.MM.YYYY.');
        // },
        ukupnoDani(){
            let ukupno = "";
            let datumOd = moment(this.time1);
            let datumDo = moment(this.time2);

            if(datumDo >= datumOd){
                let razlika = datumDo.diff(datumOd);
                razlika = moment.duration(razlika);

                return ukupno += razlika.days();
            }
            else {
                alert("Datum povratka ne moze biti manji od datuma putovanja!");
                return ukupno = "";
            }
            //provera da li je prazan datepicker 
            //range datepicker? proveriti i

        }
          
        

    },
 
  
}
</script>
