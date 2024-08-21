import sys
import socket
import subprocess
import time

# Verifica o caminho do Python que estamos usando
python_path = sys.executable

# Instala o módulo pyserial se ainda não estiver instalado
subprocess.check_call([python_path, "-m", "pip", "install", "pyserial"])

command = sys.stdin.read()

def enviar_comando_para_impressora(comando):
    try:
   
    
        
        endereco_ip = sys.argv[1]

        porta = 9100
        socket_tcp = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
        socket_tcp.connect((endereco_ip, porta))
        
        # Envia o comando para a impressora
        socket_tcp.sendall(comando.encode())

        # Adiciona uma quebra de linha para imprimir o texto
        socket_tcp.sendall(b"\n")

        # Adiciona um comando para cortar o papel (esse comando pode variar de acordo com o modelo da impressora)
        socket_tcp.sendall(b'\x1B\x69')
        
        # Fecha a conexão TCP/IP
        socket_tcp.close()

        print("Comando enviado para a impressora com sucesso!")

    except Exception as e:
        print("Erro ao enviar comando para a impressora:", e)

# Envia texto para a impressora
enviar_comando_para_impressora(command)
