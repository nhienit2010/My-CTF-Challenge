#!/bin/bash
docker rm -f your_name
docker build -t your_name . 
docker run --name=your_name --rm -p13337:13337 -it your_name