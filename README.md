# php-elasticsearch-monolith
Elasticsearch is a distributed, free and open search and analytics engine for all types of data, including textual, numerical, geospatial, structured, and unstructured. 

### TODO (Documentation to be written)
- [ ] Architecture
- [ ] Authentication and Authorisation
- [ ] Examples
- [x] Usage
- [x] Basic description

### Usage

Before API usage, do following steps
 * Rename `.env.example` into `.env`
 * Create User account using `v1/register` route
 * Run `pem:init` to initiate database with the dummy data
 * Run `migrate` and `elastic:migrate` to create sql and elasticsearch tables
 * Run `scout:import "App\Models\Random"` to populate elasticsearch
