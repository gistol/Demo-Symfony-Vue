<template>
  <form @submit.prevent="createTeam">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Equipo<strong>*</strong></h3>
      </div>   
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" class="form-control" v-model="team" placeholder="Introduce el nombre de tú equipo" required>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <div class="form-group">
          <label>Robot</label>
          <input type="text" class="form-control" v-model="robot" placeholder="Introduce el nombre de tú robot" required>
        </div>
      </div>
      <professor></professor>
    </div>
    <alumn></alumn>
    <div v-if="getTotalAlumns > 0">
      <h3>Integrantes</h3>
      <table class="table">
        <thead>
          <tr>
            <th>No. Control</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Email</th>
            <th>Carrera</th>
            <th>Semestre</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="alumn in this.$store.state.alumns">
            <td>{{ alumn.noControl }}</td>
            <td>{{ alumn.name }}</td>
            <td>{{ alumn.firstLastName }}</td>
            <td>{{ alumn.secondLastName }}</td>
            <td>{{ alumn.email }}</td>
            <td>{{ alumn.selectedCareer }}</td>
            <td>{{ alumn.semester }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <br>
    <button type="submit" class="btn btn-primary pull-right">
      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar Equipo
    </button>    
  </form>
</template>

<script>
import Professor from './Professor'
import Alumn from './Alumn'
import axios from 'axios'
const BASE_URL = 'http://localhost:8000'

export default {
  components: {
    Professor,
    Alumn
  },
  data () {
    return {
      team: null,
      robot: null
    }
  },
  methods: {
    createTeam () {
      axios.defaults.headers.common = {
        'X-Requested-With': 'XMLHttpRequest'
      }

      let team = null
      let robot = null
      let professor = null
      let alumns = []

      if ((this.team !== '' || this.team !== null)) {
        team = this.team
      }

      if ((this.robot !== '' || this.robot !== null)) {
        robot = this.robot
      }

      if ((this.$store.state.selectedProfessor === 0) && (this.$store.state.professor.name !== '' || this.$store.state.professor.name !== null) && (this.$store.state.professor.firstLastName !== '' || this.$store.state.professor.firstLastName !== null) && (this.$store.state.professor.email !== '' || this.$store.state.professor.email !== null)) {
        professor = {
          name: this.$store.state.professor.name,
          firstLastName: this.$store.state.professor.firstLastName,
          secondLastName: this.$store.state.professor.secondLastName,
          email: this.$store.state.professor.email
        }
      } else if (this.$store.state.selectedProfessor > 0) {
        professor = this.$store.state.selectedProfessor
      }

      if (this.$store.state.alumns.length > 0) {
        alumns = this.$store.state.alumns
      }

      let teamData = { team, robot, professor, alumns }

      axios.post(BASE_URL + '/api/create/new/team', teamData)
           .then(function (response) {
             console.log(response)
           })
           .catch(function (error) {
             console.log(error)
           })
      // Clean form
      this.clearForm()
    },
    clearForm () {
      this.team = ''
      this.robot = ''
      this.$store.state.selectedProfessor = 0
      this.$store.state.professor.name = null
      this.$store.state.professor.firstLastName = null
      this.$store.state.professor.secondLastName = null
      this.$store.state.professor.email = null
      this.$store.state.alumns = []
    }
  },
  computed: {
    getTotalAlumns () {
      return this.$store.state.alumns.length
    }
  }
}
</script>
