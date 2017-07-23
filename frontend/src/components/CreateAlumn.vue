<template>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <button class="btn btn-default pull-right" @click.prevent="openForm" v-show="!isCreating">
       <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
        Agregar Integrante
      </button>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="row" v-show="isCreating">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <h3>Alumno<strong>*</strong></h3>
        </div>  
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>No. Control</label>
            <input type="text" class="form-control" v-model="alumn.noControl" placeholder="No. de control del alumno">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Nombre(s)</label>
            <input type="text" class="form-control" v-model="alumn.name" placeholder="Nombre del alumno">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Apellido Paterno</label>
            <input type="text" class="form-control" v-model="alumn.firstLastName" placeholder="Apellido paterno del alumno">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Apellido Materno</label>
            <input type="text" class="form-control" v-model="alumn.secondLastName" placeholder="Apellido materno del alumno">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Correo electrónico</label>
            <input type="email" class="form-control" v-model="alumn.email" placeholder="alumno@ejemplo.com">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Carrera</label>
            <select class="form-control" v-model="alumn.selectedCareer">
              <option v-for="career in careers" :value="career.id">
                {{ career.name }}
              </option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label>Semestre</label>
            <select class="form-control" v-model="alumn.semester">
              <option value="1">Primer Semestre</option>
              <option value="2">Segundo Semestre</option>
              <option value="3">Tercer Semestre</option>
              <option value="4">Cuarto Semestre</option>
              <option value="5">Quinto Semestre</option>
              <option value="6">Sexto Semestre</option>
              <option value="7">Septimo Semestre</option>
              <option value="8">Octavo Semestre</option>
              <option value="9">Noveno Semestre</option>
            </select>
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">       
          <button class='btn btn-success pull-right' @click.prevent="addAlumn">
            <span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
            Guardar
          </button>
          <button class='btn btn-default pull-right' @click.prevent="closeForm" style="margin-right: 15px;">
            <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
            Cancelar
          </button>
        </div>        
      </div>
    </div>
  </div>	
</template>

<script>
import axios from 'axios'
const BASE_URL = 'http://localhost:8000'

export default {
  data () {
    return {
      careers: [],
      alumn: {
        noControl: '',
        name: '',
        firstLastName: '',
        secondLastName: '',
        email: '',
        selectedCareer: 0,
        semester: 0
      },
      isCreating: false
    }
  },
  mounted () {
    this.fetchCareers()
  },
  methods: {
    fetchCareers () {
      axios.get(BASE_URL + '/api/careers')
           .then(response => {
             this.careers = response.data.careers
           })
    },
    addAlumn () {
      let alumn = null

      if ((this.alumn.noControl !== '' || this.alumn.noControl !== null) && (this.alumn.name !== '' || this.alumn.name !== null) && (this.alumn.firstLastName !== '' || this.alumn.firstLastName !== null) && (this.alumn.email !== '' || this.alumn.email !== null) && (this.alumn.selectedCareer > 0) && (parseInt(this.alumn.semester) > 0)) {
        alumn = {
          noControl: this.alumn.noControl,
          name: this.alumn.name,
          firstLastName: this.alumn.firstLastName,
          secondLastName: this.alumn.secondLastName,
          email: this.alumn.email,
          selectedCareer: this.alumn.selectedCareer,
          semester: parseInt(this.alumn.semester)
        }
        this.$store.commit('addAlumn', alumn)
        this.clearForm()
        this.isCreating = false
      }
    },
    clearForm () {
      this.alumn.noControl = ''
      this.alumn.name = ''
      this.alumn.firstLastName = ''
      this.alumn.secondLastName = ''
      this.alumn.email = ''
      this.alumn.selectedCareer = 0
      this.alumn.semester = 0
    },
    openForm () {
      this.isCreating = true
    },
    closeForm () {
      this.isCreating = false
    }
  }
}
</script>
