<script setup lang="ts">
import { ref, reactive, computed } from 'vue'
import TinyMCE from '@/components/TinyMCE.vue'

defineProps<{
  title: string
}>()

const inline = ref('')
const check = ref('')
let displayFlag = ref<boolean>(false)
const myMemo = ref<string>('')
const partnerMemo = ref<string>('')
const editorMyMemo = ref()
const editorPartnerMemo = ref()
let myMemoDispFlag = ref<boolean>(false)
let partnerMemoDispFlag = ref<boolean>(false)

const clickCheck = () => {
  displayFlag.value = !displayFlag.value
}

// エディタの保存時に呼ばれ、htmlを保存する
const handleUpdMyMemo = (obj: { html: string }): void => {
  myMemo.value = obj.html
  myMemoDispFlag.value = !myMemoDispFlag.value
}
const handleUpdpartnerMemo = (obj: { html: string }): void => {
  partnerMemo.value = obj.html
  partnerMemoDispFlag.value = !partnerMemoDispFlag.value
}

// エディタのsaveを呼び出し
const saveMyMemo = (): void => {
  editorMyMemo.value.save()
}
const savePartnerMemo = (): void => {
  editorPartnerMemo.value.save()
}

const dbClickMyMemo = (): void => {
  myMemoDispFlag.value = !myMemoDispFlag.value
}
const dbClickPartnerMemo = (): void => {
  partnerMemoDispFlag.value = !partnerMemoDispFlag.value
}
</script>

<template>
  <div class="request-form">
    <v-checkbox
      class="ml-10 pl-5 checkbox"
      v-model="check"
      hide-details
      density="compact"
      @click="clickCheck"
    >
      <template #label>
        <div class="pl-3 py-3 w-100">
          {{ title }}
        </div>
      </template>
    </v-checkbox>
    <div v-if="displayFlag" class="choise-radio" style="opacity: 1">
      <div>
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
      <div class="d-flex mt-4">
        <div class="w-50">
          <v-alert
            class="mb-2 mr-2"
            color="blue-accent-4"
            text="自分用Memo"
            density="compact"
          ></v-alert>
          <div v-show="!myMemoDispFlag" class="mb-2 mr-2">
            <TinyMCE
              ref="editorMyMemo"
              :html="myMemo"
              @update="handleUpdMyMemo"
              @blur="saveMyMemo"
            />
          </div>
          <div
            v-show="myMemoDispFlag"
            class="py-2 px-3 mr-2 memo"
            v-html="myMemo"
            @dblclick="dbClickMyMemo"
          ></div>
        </div>
        <div class="w-50">
          <v-alert
            color="orange-accent-4"
            class="mb-2 mr-2"
            text="面談者Memo"
            density="compact"
          ></v-alert>
          <div v-show="!partnerMemoDispFlag" class="mb-2 mr-2">
            <TinyMCE
              ref="editorPartnerMemo"
              :html="partnerMemo"
              @update="handleUpdpartnerMemo"
              @blur="savePartnerMemo"
            />
          </div>
          <div
            v-show="partnerMemoDispFlag"
            class="py-2 px-3 mr-2 memo-partner"
            v-html="partnerMemo"
            @dblclick="dbClickPartnerMemo"
          ></div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.choise-radio {
  margin-top: 1%;
  margin-left: 4.2%;
  padding-left: 2%;
  border-left: solid;
}

.request-form .checkbox {
  color: white;
  background: linear-gradient(
    90deg,
    rgba(68, 138, 255, 1) 24%,
    rgba(255, 255, 255, 1) 100%
  );
  border-radius: 30px;
}

.request-form label {
  opacity: 1;
}

.request-form .memo {
  color: #333;
  background: #e3f2fd;
  border-left: solid 10px #2962ff;
  height: 200px;
}

.request-form .memo-partner {
  color: #333;
  background: #fff3e0;
  border-left: solid 10px #ff6d00;
  height: 200px;
}
</style>
