import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export const store = new Vuex.Store({
  state: {
    selectedProfessor: 0,
    professor: {
      name: null,
      firstLastName: null,
      secondLastName: null,
      email: null
    },
    alumn: {
      noControl: '',
      name: '',
      firstLastName: '',
      secondLastName: '',
      email: '',
      selectedCareer: 0,
      semester: 0
    }
  },
  mutations: {
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
    },
    updateAlumnNoControl (state, noControl) {
      state.alumn.noControl = noControl
    },
    updateAlumnName (state, name) {
      state.alumn.name = name
    },
    updateAlumnFirstLastName (state, firstLastName) {
      state.alumn.firstLastName = firstLastName
    },
    updateAlumnSecondLastName (state, secondLastName) {
      state.alumn.secondLastName = secondLastName
    },
    updateAlumnEmail (state, email) {
      state.alumn.email = email
    },
    updateAlumnSelectedCareer (state, selectedCareer) {
      state.alumn.selectedCareer = selectedCareer
    },
    updateAlumnSemester (state, semester) {
      state.alumn.semester = semester
    }
  }
})
