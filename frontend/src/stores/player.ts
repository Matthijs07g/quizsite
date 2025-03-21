import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

interface Player {
  name: string
  seconds: number
  isActive: boolean
}

export const usePlayerStore = defineStore('players', () => {
  const players = ref<Player[]>([])
  const currentPlayer = ref<number>(0)

  function addPlayer(name: string) {
    players.value.push({
      name,
      seconds: 60, // Start with 60 seconds
      isActive: false
    })
  }

  function decrementSeconds() {
    if (players.value[currentPlayer.value]) {
      players.value[currentPlayer.value].seconds--
    }
  }

  function nextPlayer() {
    currentPlayer.value = (currentPlayer.value + 1) % players.value.length
  }

  return { 
    players, 
    currentPlayer, 
    addPlayer, 
    decrementSeconds,
    nextPlayer
  }
})