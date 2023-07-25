<script setup lang="ts">
import { ref, reactive } from 'vue'

defineProps<{
  title: string
}>()

const inline = ref('')
const check = ref('')
let displayFlag = ref<boolean>(false)

const clickCheck = () => {
  displayFlag.value = !displayFlag.value
}
</script>

<template>
  <div>
    <v-checkbox
      style="opacity: 1"
      class="ml-10 pl-5 check-back"
      v-model="check"
      hide-details
      density="compact"
      @click="clickCheck"
    >
      <template #label>
        <div class="pl-3 py-3 w-100 check-back">
          {{ title }}
        </div>
      </template>
    </v-checkbox>
    <div v-if="displayFlag" class="choise-radio" style="opacity: 1">
      <v-radio-group v-model="inline" hide-details>
        <div class="d-flex">
          <v-radio label="具体的なアドバイスがほしい" value="1"></v-radio>
          <v-radio label="一緒に考えてほしい" value="2"></v-radio>
          <v-radio label="話を聞いてほしい" value="3"></v-radio>
        </div>
        <div class="d-flex">
          <v-radio label="意見を聞きたい" value="4"></v-radio>
          <v-radio label="報告したい" value="5"></v-radio>
          <v-radio label="その他" value="6"></v-radio>
        </div>
      </v-radio-group>
    </div>
  </div>
</template>

<style scoped>
.choise-radio {
  margin-top: 1%;
  margin-left: 4.2%;
  padding-left: 2%;
  border-left: solid;
}

.check-back {
  color: white;
  background: rgb(68, 138, 255);
  background: linear-gradient(
    90deg,
    rgba(68, 138, 255, 1) 24%,
    rgba(255, 255, 255, 1) 100%
  );
  border-radius: 30px;
}
</style>
