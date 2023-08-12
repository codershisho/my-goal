# 月次面談管理システム

## やりたいこと

- 各自の目標の進捗確認
  - 先月の取り組み内容
    - FB 結果のメモ
  - 先月の結果
    - FB 結果のメモ
  - 来月に向けて
    - FB 結果のメモ
- 他の人には参照できないように
  - 基本的には本人と上司のみ
- 面談の日程調整が可能
  - 調整が可能
  - 決まった日付を Slack 通知

## API

### ER

```plantuml
@startuml

skinparam linetype ortho

entity User {
    id:int
    --
    name:str
}
entity MTerm {
    id:int
    --
    name:str
}

entity MTopic {
    id:int
    --
    name: str
    sort: int
}

entity MTopicDetail {
    id: int
    --
    topic_id: int<<FK>>
    name: str
}

entity TGoal {
    id:int
    --
    term_id:int<<FK>>
    user_id:int<<FK>>
    goal_department: text
    gole_first: text
    gole_secound: text
}

entity TGoalDetail {
    id:int
    --
    mtg_date: date
    user_id:int<<FK>>
    partner_user_id: int<<FK>>
    topic_detail_id:int<<FK>>
    memo_own: text
    memo_partner: text
}


MTopic||-d-|{ MTopicDetail

TGoalDetail ||-d-|| User
TGoalDetail ||-r-|| MTopicDetail

TGoal ||-||User
TGoal ||-l-||MTerm


@enduml
```
