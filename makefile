# http://www.gnu.org/software/make/manual/make.html
# http://linuxlib.ru/prog/make_379_manual.html



# Ложные цели
.PHONY : build test clean

# Сборка проекта (Default)
build: vendor/composer/installed.json
	composer dump

vendor/composer/installed.json: composer.json
	composer update

# Тесты
test:
	@echo
	-phpunit -c ./tests/phpunit.xml ./tests
