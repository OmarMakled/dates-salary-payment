# Installation

To start the app you need to run `docker compose up -d` it will pull the images if not exists and spin up the containers.

```
docker compose up -d
```

**If this is the first time make sure you run** `make install` the app uses **only** dev-dependencies for testing

### PSR-12 

You can check the code against the PSR-12 coding standard by running 

```
make autofix
```

### Run test
```
make test-coverage
```

### Check code coverage
`http://localhost:3000/`


### Export date
```
make export file="output.csv"
```

### Stop/Start app

Run `make stop` or `make up`