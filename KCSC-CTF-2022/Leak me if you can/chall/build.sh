#!/bin/bash
docker rm -f leak_me
docker build -t leak_me . 
docker run --name=leak_me --rm -p13337:13337 -it leak_me