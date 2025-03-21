<script setup lang="ts">
import { ref, onUnmounted, onMounted } from 'vue'
import { usePlayerStore } from '@/stores/player'

const playerStore = usePlayerStore()
const newPlayerName = ref('')
const gameStarted = ref(false)
const questionTimer = ref(30)
const showAnswer = ref(false)
let timer: number | undefined

async function startGame() {
  if (playerStore.players.length >= 2) {
    gameStarted.value = true
    playerStore.players[0].isActive = true
    await loadNextQuestion()
    startQuestionTimer()
  }
}

async function loadNextQuestion() {
  const question = await playerStore.getRandomQuestion()
  if (!question) {
    console.error('Failed to load question')
    return
  }
  showAnswer.value = false
}

function startQuestionTimer() {
  questionTimer.value = 30
  timer = setInterval(() => {
    questionTimer.value--
    if (questionTimer.value <= 0) {
      handleWrongAnswer()
    }
  }, 1000)
}

function resetQuestionTimer() {
  if (timer) clearInterval(timer)
  startQuestionTimer()
}

async function handleKeyPress(event: KeyboardEvent) {
  if (!gameStarted.value) return

  if (event.key === 'Enter') { // Correct answer
    await handleCorrectAnswer()
  } else if (event.key === 'Backspace') { // Wrong answer
    await handleWrongAnswer()
  } else if (event.key === ' ') { // Space to show/hide answer
    showAnswer.value = !showAnswer.value
  }
}

async function handleCorrectAnswer() {
  if (timer) clearInterval(timer)
  
  playerStore.nextQuestion()
  
  if (playerStore.currentQuestion > 9) {
    endQuestionPhase()
    return
  }
  
  await loadNextQuestion()
  resetQuestionTimer()
}

async function handleWrongAnswer() {
  if (timer) clearInterval(timer)
  
  playerStore.nextPlayer()
  playerStore.nextQuestion()
  
  if (playerStore.currentQuestion > 9) {
    endQuestionPhase()
    return
  }
  
  await loadNextQuestion()
  resetQuestionTimer()
}

function endQuestionPhase() {
  gameStarted.value = false
  if (timer) clearInterval(timer)
  // Implement transition to next game phase here
}

onMounted(() => {
  window.addEventListener('keydown', handleKeyPress)
})

onUnmounted(() => {
  if (timer) clearInterval(timer)
  window.removeEventListener('keydown', handleKeyPress)
})
</script>

<template>
  <div class="player-management">
    <!-- Player setup section (same as before) -->
    <div v-if="gameStarted && playerStore.currentQuestionData" class="question-phase">
      <div class="question-info">
        <h2>Question {{ playerStore.currentQuestion }} of 9</h2>
        <div class="question-value">
          Worth: {{ playerStore.isSpecialQuestion() ? 10 : 5 }} seconds
        </div>
        <div class="question-timer">
          Time remaining: {{ questionTimer }}s
        </div>
      </div>

      <div class="question-display">
        <h3>Question:</h3>
        <p>{{ playerStore.currentQuestionData.vraag }}</p>
        <div v-if="showAnswer" class="answer">
          <h4>Answer:</h4>
          <p>{{ playerStore.currentQuestionData.antwoord }}</p>
        </div>
      </div>

      <div class="players-status">
        <div 
          v-for="player in playerStore.players" 
          :key="player.name"
          :class="['player-card', { active: player.isActive }]"
        >
          <h3>{{ player.name }}</h3>
          <div class="seconds">{{ player.seconds }}s</div>
        </div>
      </div>

      <div class="controls-info">
        <p>SPACE: Show/Hide Answer</p>
        <p>ENTER: Correct Answer</p>
        <p>BACKSPACE: Wrong Answer</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Add to existing styles */
.question-display {
  background: var(--slimste-mens-blue);
  padding: 2rem;
  border-radius: 8px;
  margin: 1rem 0;
}

.answer {
  margin-top: 1rem;
  padding-top: 1rem;
  border-top: 1px solid var(--slimste-mens-gold);
}
</style>