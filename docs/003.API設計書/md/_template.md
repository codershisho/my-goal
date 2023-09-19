@import "../../090.other/md-css/markdown.less"

# API-XXX

## XXXXX API

### 処理概要

- XXXXXXX

### データアクセス

```mermaid
graph LR
  p1((API))
  db1[(table)]
  db2[(table)]

  p1 --> db1
  db1 -.relation.- db2
```

#### t_goals(ユーザーマスタ)

- deleted_at = is null

### 処理フロー

#### フローチャート

```mermaid
graph TD
  s([start])
  e([end])

  s --> e
```

#### 処理シーケンス

```mermaid
sequenceDiagram
autonumber
participant api as <<API>><br>GoalApi
participant se as <<Service>><br>IndexService
participant irepo as <<Interface>><br>IGoalRepository
participant repo as <<Repository>><br>GoalRepository
participant m as <<Model>><br>Model
participant res as <<Resource>><br>GoalResource

```

### Request

#### path params

なし

#### body params

なし

#### sample json

なし

### Response

#### 200 ステータス

##### base

| key     | type   | value | note |
| :------ | :----- | :---- | :--- |
| data    | array  |       |      |
| message | string |       |      |

##### sample json

```json5
{}
```

#### 503 ステータス

- Laravel 側の**想定内の例外**は handler.php で制御している
  - 要求を処理できないことを示す 503 ステータスを使用
- 独自例外クラスの AppException を throw したら、下の形式で返される

```json5
{
  message: '※throwされたメッセージ',
}
```

#### 500 ステータス

- Laravel 側の**想定外の例外**は handler.php で制御しているため考慮不要

```json5
{
  message: 'uncatch exception'
  errorFile: '',
  errorLine: '',
  errorDetail: '',
}
```
