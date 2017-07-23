import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    alumns: [],
    team: {
      name: null
    },
    robot: {
      name: null
    },
    selectedProfessor: 0,
    professor: {
      name: null,
      firstLastName: null,
      secondLastName: null,
      email: null
    }
  },
  mutations: {
    addAlumn (state, alumn) {
      state.alumns.push(alumn)
    },
    updateTeamName (state, name) {
      state.team.name = name
    },
    updateRobotName (state, name) {
      state.robot.name = name
    },
    updateSelectedProfessor (state, selectedProfessor) {
      state.selectedProfessor = selectedProfessor
    },
    updateProfessorName (state, name) {
      state.professor.name = name
    },
    updateProfessorFirstLastName (state, firstLastName) {
      state.professor.firstLastName = firstLastName
    },
    updateProfessorSecondLastName (state, secondLastName) {
      state.professor.secondLastName = secondLastName
    },
    updateProfessorEmail (state, email) {
      state.professor.email = email
    }
  }
})
