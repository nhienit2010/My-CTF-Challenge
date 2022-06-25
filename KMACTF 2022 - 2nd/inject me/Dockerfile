FROM python:3.8-slim

RUN useradd -m ctf

WORKDIR /app

COPY src/ .

RUN apt update -y
RUN pip3 install --upgrade --no-cache-dir -r requirements.txt

RUN chown -R root:ctf /app && \
    chmod 750 /app /app/app.py

USER ctf

CMD ["/usr/local/bin/python", "/app/app.py"]

EXPOSE 80