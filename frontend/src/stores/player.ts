import { ref } from 'vue'
import { defineStore } from 'pinia'
import axios from 'axios'

interface Player {
  name: string
  seconds: number
  isActive: boolean
}

interface Question {
  id: number
  vraag: string
  antwoord: string
}

export const usePlayerStore = defineStore('players', () => {
  const players = ref<Player[]>([])
  const currentPlayer = ref<number>(0)
  const currentQuestion = ref<number>(1)
  const usedQuestionIds = ref<number[]>([])
  const currentQuestionData = ref<Question | null>(null)

  async function getRandomQuestion() {
    try {
      const response = await axios.get('http://localhost:8000/api/369/random')
      const question = response.data
      
      // Check if question was already used
      if (usedQuestionIds.value.includes(question.id)) {
        // If question was used, try getting another one
        return getRandomQuestion()
      }
      
      // Add question ID to used questions
      usedQuestionIds.value.push(question.id)
      currentQuestionData.value = question
      return question
    } catch (error) {
      console.error('Error fetching question:', error)
      return null
    }
  }

  function addPlayer(name: string) {
    players.value.push({
      name,
      seconds: 60,
      isActive: false
    })
  }

  function nextPlayer() {
    players.value[currentPlayer.value].isActive = false
    currentPlayer.value = (currentPlayer.value + 1) % players.value.length
    players.value[currentPlayer.value].isActive = true
  }

  function nextQuestion() {
    currentQuestion.value++
  }

  function isSpecialQuestion() {
    return [3, 6, 9].includes(currentQuestion.value)
  }

  return {
    players,
    currentPlayer,
    currentQuestion,
    currentQuestionData,
    addPlayer,
    nextPlayer,
    nextQuestion,
    isSpecialQuestion,
    getRandomQuestion
  }
})