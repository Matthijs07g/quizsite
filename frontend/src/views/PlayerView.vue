<script setup lang="ts">
import { ref, onUnmounted } from 'vue'
import { usePlayerStore } from '@/stores/player'

const playerStore = usePlayerStore()
const newPlayerName = ref('')
const gameStarted = ref(false)
let timer: number | undefined

function addPlayer() {
  if (newPlayerName.value.trim()) {
    playerStore.addPlayer(newPlayerName.value)
    newPlayerName.value = ''
  }
}

function startGame() {
  if (playerStore.players.length >= 2) {
    gameStarted.value = true
    playerStore.players[0].isActive = true
    startTimer()
  }
}

function startTimer() {
  timer = setInterval(() => {
    playerStore.decrementSeconds()
    if (playerStore.players[playerStore.currentPlayer].seconds <= 0) {
      nextTurn()
    }
  }, 1000)
}

function nextTurn() {
  playerStore.players[playerStore.currentPlayer].isActive = false
  playerStore.nextPlayer()
  playerStore.players[playerStore.currentPlayer].isActive = true
}

onUnmounted(() => {
  if (timer) clearInterval(timer)
})
</script>

<template>
  <div class="player-management">
    <div v-if="!gameStarted" class="player-setup">
      <h1>De Slimste Mens</h1>
      <div class="add-player">
        <input 
          v-model="newPlayerName"
          placeholder="Enter player name"
          @keyup.enter="addPlayer"
        >
        <button @click="addPlayer">Add Player</button>
      </div>
      
      <div class="player-list">
        <h2>Players:</h2>
        <ul>
          <li v-for="player in playerStore.players" :key="player.name">
            {{ player.name }} - {{ player.seconds }}s
          </li>
        </ul>
      </div>

      <button 
        @click="startGame"
        :disabled="playerStore.players.length < 2"
        class="start-button"
      >
        Start Game
      </button>
    </div>

    <div v-else class="game-board">
      <div 
        v-for="player in playerStore.players" 
        :key="player.name"
        :class="['player-card', { active: player.isActive }]"
      >
        <h2>{{ player.name }}</h2>
        <div class="seconds">{{ player.seconds }}s</div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.player-management {
  background-color: var(--slimste-mens-black);
  padding: 2rem;
  border-radius: 8px;
}

.player-setup {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
}

h1 {
  color: var(--slimste-mens-gold);
  font-size: 3rem;
  text-transform: uppercase;
}

.add-player {
  display: flex;
  gap: 1rem;
}

input {
  padding: 0.5rem;
  font-size: 1.2rem;
  border: 2px solid var(--slimste-mens-blue);
  background: transparent;
  color: white;
}

button {
  padding: 0.5rem 1rem;
  background-color: var(--slimste-mens-blue);
  color: white;
  border: none;
  cursor: pointer;
  font-weight: bold;
}

.start-button {
  background-color: var(--slimste-mens-gold);
  color: black;
  padding: 1rem 2rem;
  font-size: 1.2rem;
}

.game-board {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
}

.player-card {
  background-color: var(--slimste-mens-blue);
  padding: 1rem;
  border-radius: 8px;
  text-align: center;
}

.player-card.active {
  border: 2px solid var(--slimste-mens-gold);
}

.seconds {
  font-size: 3rem;
  color: var(--slimste-mens-gold);
  font-weight: bold;
}
</style>