import os
import subprocess
import pyodbc
import requests

# Verifica se o módulo requests está disponível
try:
    import requests
except ImportError:
    # Se o módulo requests não estiver disponível, tenta instalá-lo
    try:
        subprocess.run(["pip", "install", "requests"])
        import requests
    except Exception as e:
        print("Erro ao instalar o módulo requests:", e)
        exit(1)

# Configurações de conexão
server = 'CEDRO\\SQLEXPRESS'
database = 'multiclubes'
username = 'integracaowk'
password = 'integracaowk'

# Estabelecendo a conexão
conn = pyodbc.connect('DRIVER={SQL Server};SERVER='+server+';DATABASE='+database+';UID='+username+';PWD='+ password)

# Executando uma consulta
cursor = conn.cursor()
cursor.execute('SELECT Titles.Code as "ID", Members.Name as "NOME COMPLETO", Members.Document as "CPF", Members.BirthDate as "DATA NASCIMENTO™", Members.Email as "E-MAIL", Members.MobilePhone as "CELULAR" FROM Titles, Members WHERE Titles.Id = Members.Title AND Titles.Status = 0 AND Members.Status = 0 AND Titles.TitleType IN (496666, 461484)')

# Obtendo os resultados da consulta
rows = cursor.fetchall()

# Definindo o caminho do arquivo SQL
file_path = 'inserts.sql'

# Abre o arquivo para escrita
with open(file_path, 'w') as f:
    # Itera sobre as linhas retornadas da consulta
    for row in rows:
        # Extrai os valores de cada coluna
        id = row[0]  # ID
        nome_completo = row[1]  # NOME COMPLETO
        cpf = row[2]  # CPF
        data_nascimento = row[3]  # DATA NASCIMENTO
        email = row[4]  # E-MAIL
        celular = row[5]  # CELULAR
        insert_statement = f"INSERT INTO `freelancer` (`ID_freelancer`, `Nome_Completo`, `CPF`, `Data_Nascimento`, `Status`, `Email`, `Celular`) VALUES (NULL, '{nome_completo}', '{cpf}', '{data_nascimento}', '', '{email}', '{celular}');\n"
        f.write(insert_statement)

print(f"Arquivo '{file_path}' criado com sucesso!")

# Enviar o arquivo para a API
api_url = 'http://192.168.156.150:81/API/atualizar_dados_freelancer_API.php'
files = {'file': open(file_path, 'rb')}
response = requests.post(api_url, files=files)

# Verifica o status de resposta da API
if response.status_code == 200:
    print("Arquivo enviado com sucesso para a API!")
    # Remove o arquivo .sql após o sucesso
    os.remove(file_path)
    print(f"Arquivo '{file_path}' removido com sucesso!")
else:
    print("Erro ao enviar o arquivo para a API.")
