<template>
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <h2><strong>Registro</strong></h2>
      <p class="lead blog-description">Las secciones con <strong>*</strong> son requeridas para un registro válido.</p>
      <form @submit.prevent="createTeam">
        <team></team>
        <alumn-list :alumns="alumns"></alumn-list>
        <create-alumn></create-alumn>
        <br><br><br>
        <button type="submit" class="btn btn-primary pull-right">
          <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Registrar Equipo
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import AlumnList from './components/AlumnList'
import CreateAlumn from './components/CreateAlumn'
import Team from './components/Team'
import axios from 'axios'
const BASE_URL = 'http://localhost:8000'
import 'bootstrap-sweetalert/dist/sweetalert.css'
import swal from 'bootstrap-sweetalert'

export default {
  name: 'app',
  data () {
    return {
      alumns: this.$store.state.alumns
    }
  },
  components: {
    AlumnList,
    CreateAlumn,
    Team
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

      if ((this.$store.state.team.name !== '' || this.$store.state.team.name !== null)) {
        team = this.$store.state.team.name
      }

      if ((this.$store.state.robot.name !== '' || this.$store.state.robot.name !== null)) {
        robot = this.$store.state.robot.name
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
             swal('¿Correcto!', 'Equipo registrado satisfactoriamente', 'success')
           })
           .catch(function (error) {
             console.log(error)
           })
      // Clean form
      this.clearForm()
    },
    clearForm () {
      this.$store.state.team.name = ''
      this.$store.state.robot.name = ''
      this.$store.state.selectedProfessor = 0
      this.$store.state.professor.name = null
      this.$store.state.professor.firstLastName = null
      this.$store.state.professor.secondLastName = null
      this.$store.state.professor.email = null
      this.$store.state.alumns = []
    }
  }
}
</script>
