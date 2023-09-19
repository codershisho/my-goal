db:
	docker-compose build
db-no:
	docker-compose build --no-cache
du:
	docker-compose up -d
due:
	docker-compose up -d
	docker-compose exec -u root app bash
de:
	docker-compose exec -u root app bash
dd:
	docker-compose down