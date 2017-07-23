<template>
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h3>Alumno<strong>*</strong></h3>
    </div>  
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>No. Control</label>
        <input type="text" class="form-control" v-model="noControl" placeholder="No. de control del capitan" required>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Nombre(s)</label>
        <input type="text" class="form-control" v-model="name" placeholder="Nombre del capitan" required>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Apellido Paterno</label>
        <input type="text" class="form-control" v-model="firstLastName" placeholder="Apellido paterno del capitan" required>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Apellido Materno</label>
        <input type="text" class="form-control" v-model="secondLastName" placeholder="Apellido materno del capitan">
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Correo electrónico</label>
        <input type="email" class="form-control" v-model="email" placeholder="capitan@ejemplo.com" required>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Carrera</label>
        <select class="form-control" v-model="selectedCareer" required>
          <option v-for="career in careers" :value="career.id">
            {{ career.name }}
          </option>
        </select>
      </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
      <div class="form-group">
        <label>Semestre</label>
        <select class="form-control" v-model="semester" required>
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
  </div>	
</template>

<script>
import axios from 'axios'
const BASE_URL = 'http://localhost:8000'

export default {
  data () {
    return {
      careers: []
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
    }
  },
  computed: {
    noControl: {
      get () {
        return this.$store.state.alumn.noControl
      },
      set (value) {
        this.$store.commit('updateAlumnNoControl', value)
      }
    },
    name: {
      get () {
        return this.$store.state.alumn.name
      },
      set (value) {
        this.$store.commit('updateAlumnName', value)
      }
    },
    firstLastName: {
      get () {
        return this.$store.state.alumn.firstLastName
      },
      set (value) {
        this.$store.commit('updateAlumnFirstLastName', value)
      }
    },
    secondLastName: {
      get () {
        return this.$store.state.alumn.secondLastName
      },
      set (value) {
        this.$store.commit('updateAlumnSecondLastName', value)
      }
    },
    email: {
      get () {
        return this.$store.state.alumn.email
      },
      set (value) {
        this.$store.commit('updateAlumnEmail', value)
      }
    },
    selectedCareer: {
      get () {
        return this.$store.state.alumn.selectedCareer
      },
      set (value) {
        this.$store.commit('updateAlumnSelectedCareer', value)
      }
    },
    semester: {
      get () {
        return this.$store.state.alumn.semester
      },
      set (value) {
        this.$store.commit('updateAlumnSemester', value)
      }
    }
  }
}
</script>
