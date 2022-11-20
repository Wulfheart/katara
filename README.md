# Katara

A simple way to self-host your projects.

## Features for pre-release

- A user can have multiple projects
- A project can have multiple services
- Service types:
  - Web
  - Worker
  - Database
    - Postgres
  - Cron
  - Redis (only in a later iteration)
- Environment groups


## Commands

### Install prometheus

```bash
helm repo add prometheus-community \
  https://prometheus-community.github.io/helm-charts

helm upgrade --install \
  -f https://raw.githubusercontent.com/cloudnative-pg/cloudnative-pg/main/docs/src/samples/monitoring/kube-stack-config.yaml \
  prometheus-community \
  prometheus-community/kube-prometheus-stack
```
