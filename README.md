# QR Code Setup System

Sistema de gerenciamento de setups com leitura de QR Code para parafusadeiras, desenvolvido em Laravel com Docker.

## 📋 Sobre o Projeto

Sistema para controle de setups de parafusadeiras em ambiente industrial, permitindo:
- Leitura de QR codes de colaboradores e equipamentos (parafusadeiras)
- Registro de torque informado durante o processo
- Fluxo em etapas para validação de setup
- Geração de QR codes para colaboradores e produtos
- Autenticação de usuários com controle de acesso
- CRUDs completos para gerenciamento

## 🚀 Tecnologias

- **Laravel 10** - Framework PHP
- **MySQL 8.0** - Banco de dados
- **Nginx** - Servidor web
- **Docker & Docker Compose** - Containerização
- **Bootstrap 5** - Interface responsiva
- **SimpleSoftwareIO QR Code** - Geração de QR codes

## 📦 Requisitos

- Docker
- Docker Compose
- Git

## 🔧 Instalação

### 1. Entre no repositório

```bash
cd qrcode
```

### 2. Configure o arquivo .env

```bash
cp .env.example .env
```

Verifique as configurações do banco de dados no `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=qrcode
DB_USERNAME=qrcode
DB_PASSWORD=qrcode
```

### 3. Build e start dos containers Docker

```bash
docker compose up -d --build
```

### 4. Instale as dependências do Composer

```bash
docker compose exec app composer install
```

### 5. Gere a chave da aplicação

```bash
docker compose exec app php artisan key:generate
```

### 6. Execute as migrations e seeds

```bash
docker compose exec app php artisan migrate:fresh --seed
```

### 7. Ajuste permissões (se necessário)

```bash
docker compose exec app chmod -R 777 storage bootstrap/cache
```

## 🌐 Serviços e Portas

| Serviço | Container | Porta | Acesso |
|---------|-----------|-------|--------|
| **Aplicação Web** | qrcode_nginx | 8443 | http://localhost:8443 |
| **MySQL** | qrcode_mysql | 3306 | localhost:3306 |
| **PHP-FPM** | qrcode_app | - | Interno |

## 🔑 Acesso ao Sistema

### Credenciais Padrão

Após executar as seeds, use as seguintes credenciais para login:

- **Email:** admin@admin.com
- **Senha:** admin123

### URLs Principais

- **Fluxo QR (Público):** http://localhost:8443/flow
- **Login:** http://localhost:8443/login
- **Dashboard:** http://localhost:8443/colaboradores (após login)

## 📱 Funcionalidades

### Área Pública
- **Fluxo de Setup:** Leitura de QR codes em duas etapas (colaborador e parafusadeira)

### Área Administrativa (requer login)
- **Colaboradores:** CRUD completo + geração de QR code
- **Produtos:** CRUD completo + geração de QR code (parafusadeiras)
- **Setups:** Listagem de registros de setups realizados
- **Usuários:** Gerenciamento de usuários do sistema

## 🔄 Fluxo de Leitura QR

1. **Etapa 1:** Ler QR code do colaborador (matrícula)
   - Exibe: matrícula, nome, função
   - Botão para avançar

2. **Etapa 2:** Ler QR code da parafusadeira
   - Exibe: código, número sequencial, posto, linha, setor, torque padrão
   - **Campo obrigatório:** Informar torque medido
   - Botão para confirmar

3. **Conclusão:** Registra setup com timestamps e dados completos

## 🗄️ Banco de Dados

### Dados de Exemplo (Seeds)

**Colaboradores:**
- C001 - João Silva (Auxiliar de Produção)
- C002 - Maria Oliveira (Operador de Linha)
- C003 - Pedro Santos (Técnico de Manutenção)

**Parafusadeiras:**
- PFD-001 a PFD-005 (Diversos postos e linhas)

## 🛠️ Comandos Úteis

### Acessar container da aplicação
```bash
docker compose exec app bash
```

### Acessar MySQL
```bash
docker compose exec mysql mysql -u qrcode -pqrcode qrcode
```

### Logs em tempo real
```bash
docker compose logs -f app
```

### Parar containers
```bash
docker compose down
```

### Resetar banco de dados
```bash
docker compose exec app php artisan migrate:fresh --seed
```

### Executar apenas seeds
```bash
docker compose exec app php artisan db:seed
```

## 📸 Geração de QR Codes

O sistema utiliza a biblioteca `simplesoftwareio/simple-qrcode` para geração server-side de QR codes em formato SVG, garantindo:
- Alta qualidade
- Escalabilidade
- Funcionamento offline
- Pronto para impressão

## 🔒 Segurança

- Rotas administrativas protegidas por middleware `auth`
- Senhas criptografadas com bcrypt
- Validação de dados em todas as requisições
- Proteção CSRF em formulários

