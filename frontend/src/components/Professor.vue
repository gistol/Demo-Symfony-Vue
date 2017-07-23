<template>
  <div class="container">
    <div v-if="!newProfessor">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <label>Asesor</label>
          <select class="form-control" v-model="selectedProfessor">
            <option v-for="professor in professors" :value="professor.id">
              {{ professor.name }} {{ professor.firstLastName }} {{ professor.secondLastName }}
            </option>
          </select>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-md-offset-8 col-lg-offset-8">
        <div class="form-group">
          <input type="checkbox" @click="markNewProfessor" /> Marca, si requieres registrar un nuevo asesor
        </div>
      </div>
    </div>
    <div v-if="newProfessor" class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Asesor<strong>*</strong></h3>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <label>Nombre(s)</label>
          <input type="text" class="form-control" v-model="name" placeholder="Nombre de tú asesor">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <label>Apellido Paterno</label>
          <input type="text" class="form-control" v-model="firstLastName" placeholder="Apellido paterno de tú asesor">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <label>Apellido Materno</label>
          <input type="text" class="form-control" v-model="secondLastName" placeholder="Apellido materno de tú asesor">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <div class="form-group">
          <label>Correo electrónico</label>
          <input type="email" class="form-control" v-model="email" placeholder="asesor@ejemplo.com">
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
          <input type="checkbox" @click="unMarkNewProfessor" /> Marca, para seleccionar un asesor registrado
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
      professors: [],
      newProfessor: false
    }
  },
  mounted () {
    this.fetchProfessors()
  },
  methods: {
    fetchProfessors () {
      axios.get(BASE_URL + '/api/professors')
           .then(response => {
             this.professors = response.data.professors
           })
    },
    markNewProfessor () {
      this.newProfessor = true
      this.$store.commit('updateSelectedProfessor', 0)
    },
    unMarkNewProfessor () {
      this.newProfessor = false
      this.$store.commit('updateSelectedProfessor', 0)
    }
  },
  computed: {
    selectedProfessor: {
      get () {
        return this.$store.state.selectedProfessor
      },
      set (value) {
        this.$store.commit('updateSelectedProfessor', value)
      }
    },
    name: {
      get () {
        return this.$store.state.professor.name
      },
      set (value) {
        this.$store.commit('updateProfessorName', value)
      }
    },
    firstLastName: {
      get () {
        return this.$store.state.professor.firstLastName
      },
      set (value) {
        this.$store.commit('updateProfessorFirstLastName', value)
      }
    },
    secondLastName: {
      get () {
        return this.$store.state.professor.secondLastName
      },
      set (value) {
        this.$store.commit('updateProfessorSecondLastName', value)
      }
    },
    email: {
      get () {
        return this.$store.state.professor.email
      },
      set (value) {
        this.$store.commit('updateProfessorEmail', value)
      }
    }
  }
}
</script>
