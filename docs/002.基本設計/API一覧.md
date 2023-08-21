@import "../090.other/md-css/markdown.less"

# API 一覧

## 一覧表

- prefix
  - `api/my-goal/`

| 画面 ID     | 画面           | API ID  | API 概要                 | API Method | API URL          | API Class   | API Action |
| ----------- | -------------- | ------- | ------------------------ | ---------- | ---------------- | ----------- | ---------- |
| SCR-001-001 | ログイン       | API-001 | ログイン                 |            |                  |             |            |
| SCR-001-001 | ログイン       | API-002 | アカウント作成           |            |                  |             |            |
| SCR-001-001 | ログイン       | API-003 | パスワード変更           |            |                  |             |            |
| SCR-002-001 | ダッシュボード | API-004 | 目標（部・目標 1,2）検索 | GET        | /goals/{term_id} | GoalApi.php | index      |
| SCR-002-001 | ダッシュボード | API-005 | 目標（部・目標 1,2）更新 | PUT        | /goals/{term_id} | GoalApi.php | update     |
| SCR-003-001 | 面談情報       | API-006 | MTG 実施履歴一覧検索     | GET        | /mtgs            | MtgApi.php  | index      |
| SCR-003-001 | 面談情報       | API-007 | MTG 実施履歴詳細検索     | GET        | /mtgs/{mtg}      | MtgApi.php  | show       |
| SCR-003-001 | 面談情報       | API-008 | MTG 実施履歴詳細削除     | DELETE     | /mtgs/{mtg}      | MtgApi.php  | destroy    |
| SCR-004-001 | 面談作成       | API-009 | 面談者検索               | GET        | /users           | UserApi.php | index      |
| SCR-004-001 | 面談作成       | API-010 | MTG 実施履歴詳細登録     | POST       | /mtgs            | MtgApi.php  | create     |
