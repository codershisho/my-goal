# My Goal

<p>会社での個人目標を管理したり、メンバー間の月次面談(1on1)を管理することができます。</p>

<b>目標の管理</b>
![image](https://github.com/codershisho/my-goal/assets/120914888/a633398c-a468-4f5d-a936-7f762acaee9b)

<b>月次面談（1on1）の管理</b>
![image](https://github.com/codershisho/my-goal/assets/120914888/b7839526-ebb2-46b7-837d-cab0b10d9cee)

## 作成の背景

- プロジェクトメンバー毎の目標や進捗状況を把握したい
- メンバーからの相談内容を他メンバーには秘密にしたい
  - いろんなツールで実現できると思いますが
    - メンバー分のパスワードを用意・管理しないと・・・
    - あ～めんどｋ・・・ry
    - みたいな環境だったので作っちゃえと。
- 習得していない言語のキャッチアップも兼ねて

## 使用した言語・環境

<p align="left">
  <a href="https://www.docker.com/" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/docker/docker-original-wordmark.svg"
      alt="docker"
      width="40"
      height="40"
    />
  </a>
  <a href="https://git-scm.com/" target="_blank" rel="noreferrer">
    <img
      src="https://www.vectorlogo.zone/logos/git-scm/git-scm-icon.svg"
      alt="git"
      width="40"
      height="40"
    />
  </a>
  <a
    href="https://developer.mozilla.org/en-US/docs/Web/JavaScript"
    target="_blank"
    rel="noreferrer"
  >
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg"
      alt="javascript"
      width="40"
      height="40"
    />
  </a>
  <a href="https://laravel.com/" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-plain-wordmark.svg"
      alt="laravel"
      width="40"
      height="40"
    />
  </a>
  <a href="https://www.linux.org/" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/linux/linux-original.svg"
      alt="linux"
      width="40"
      height="40"
    />
  </a>
  <a href="https://mariadb.org/" target="_blank" rel="noreferrer">
    <img
      src="https://www.vectorlogo.zone/logos/mariadb/mariadb-icon.svg"
      alt="mariadb"
      width="40"
      height="40"
    />
  </a>
  <a href="https://www.nginx.com" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/nginx/nginx-original.svg"
      alt="nginx"
      width="40"
      height="40"
    />
  </a>
  <a href="https://nodejs.org" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/nodejs/nodejs-original-wordmark.svg"
      alt="nodejs"
      width="40"
      height="40"
    />
  </a>
  <a href="https://www.php.net" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg"
      alt="php"
      width="40"
      height="40"
    />
  </a>
  <a href="https://www.typescriptlang.org/" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/typescript/typescript-original.svg"
      alt="typescript"
      width="40"
      height="40"
    />
  </a>
  <a href="https://vuejs.org/" target="_blank" rel="noreferrer">
    <img
      src="https://raw.githubusercontent.com/devicons/devicon/master/icons/vuejs/vuejs-original-wordmark.svg"
      alt="vuejs"
      width="40"
      height="40"
    />
  </a>
  <a href="https://vuetifyjs.com/en/" target="_blank" rel="noreferrer">
    <img
      src="https://bestofjs.org/logos/vuetify.svg"
      alt="vuetify"
      width="40"
      height="40"
    />
  </a>
</p>

### 環境

| item           | version                                             | note         |
| -------------- | --------------------------------------------------- | ------------ |
| OS             | windows 11                                          |              |
| WSL            | WSL 2 Ubuntu-22.04                                  |              |
| Docker         | Docker version 24.0.6                               | WSL 上に構築 |
| Docker-compose | docker-compose version 1.29.2                       | WSL 上に構築 |
| Github         |                                                     |              |
| DockerHub      | [link](https://hub.docker.com/search?q=codershisho) |              |

### フロントエンド

| item            | version | note                                     |
| --------------- | ------- | ---------------------------------------- |
| nginx           | 1.25.0  | docker で稼働                            |
| node            | 18.17.1 | docker で稼働                            |
| vite            | 4.0.0   |                                          |
| Vue             | 3.3.4   |                                          |
| Vuetify         | 3.3.6   | CSS フレームワークとして使用             |
| Vue Router      | 4.2.2   | ルーティングで使用                       |
| pinia           | 2.1.6   | ストアで使用                             |
| vue-tsc         | 1.8.6   | キャッチアップを兼ねて Typescript を使用 |
| vueup/vue-quill | 1.2.0   | リッチな WYSIWYG エディターとして使用    |

### バックエンド

| item    | version | note          |
| ------- | ------- | ------------- |
| php     | 8.2.8   | docker で稼働 |
| Laravel | 9.52.15 |               |
| mariaDB | 10.9    | dokcer で稼働 |

## 使用方法

### インストール方法

<b>※wsl 上の適当な作業フォルダで実施</b>

Clone

```bash
git clone -b main https://github.com/codershisho/my-goal.git
```

Docker の準備

env ファイルのコピー

```bash
cp .env.example .env
```

```bash
docker-compose build
docker-compose up -d
docker-compose exec -u root app bash
```

<b>※以降は app コンテナ内で実行</b>

Laravel の設定

```bash
composer install
php artisan key:generate
chown www-data:www-data ./storage/ -R
php artisan storage:link
```

Node の設定

```bash
npm install -f
```

migrate & seeder

```bash
php artisan migrate
php artisan db:seed
```

ローカルサーバー起動

```bash
npm run dev
```

ローカル環境で稼働確認
[localhost](http://localhost/login)

## 工夫したポイント

- <b>デザイン面</b>

  動きや、ロジックを考えて実装することは得意としているのですが、
  UI/UX については、未熟者すぎるため、CSS フレームワークを使用して極力きれいにしました。
  また、light/dark テーマの切り替えも容易に実現できました。

- <b>WYSIWYG エディター</b>

  毎月の目標進捗確認の際に、重要事項や備忘のために文字の装飾をしたいと思っていて、
  初めて WYSIWYG エディターを導入してみました。

- <b>習得していない言語のキャッチアップ</b>

  Vue3 や Vite、Typescript を初めて使用して開発を実施しました。
  また、掴みかけている段階ですが、今までよりは理解が進みました。
  開発の効率もあがったので継続して、臆することなくキャッチアップしていこうとおもいます。

## 今後について

- マスタメンテ用画面の追加
- 実施した月次面談（1on1）の評価を相談者にしてもらう
- 実施した月次面談（1on1）回数や相談者の評価をグラフ化
- Google カレンダーと連携
- ・・・etc

を予定してます。
