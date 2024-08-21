import sys
import subprocess
import serial
import time

# Verifica o caminho do Python que estamos usando
python_path = sys.executable

# Instala o módulo serial se ainda não estiver instalado
subprocess.check_call([python_path, "-m", "pip", "install", "pyserial"])

command = sys.stdin.read()

def enviar_comando_para_impressora(comando):
    try:
        # Abre a conexão serial com a porta onde a impressora está conectada
        porta_serial = serial.Serial('COM7', 9600, timeout=1)
        
        # Espera um momento para a comunicação serial se estabelecer
        time.sleep(2)
        
        # Envia o comando para a impressora
        porta_serial.write(comando.encode())
        
        # Adiciona uma quebra de linha para imprimir o texto
        porta_serial.write(b"\n")

        # Adiciona um comando para cortar o papel (esse comando pode variar de acordo com o modelo da impressora)
        porta_serial.write(b'\x1B\x69')
        
        # Fecha a conexão serial
        porta_serial.close()

        response = porta_serial.readline()
        print("Resposta da impressora:", response)

    except Exception as e:
        print("Erro ao enviar comando para a impressora:", e)

# Envia texto para a impressora
enviar_comando_para_impressora(command)
