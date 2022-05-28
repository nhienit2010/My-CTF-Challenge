FROM node:current-buster-slim

# Install packages
RUN apt-get update \
    && apt-get install -y wget supervisor gnupg \
    && wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
    && sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' \
    && apt-get update \
    && apt-get install -y google-chrome-stable fonts-ipafont-gothic fonts-wqy-zenhei fonts-thai-tlwg fonts-kacst fonts-freefont-ttf libxss1 \
    --no-install-recommends \
    && rm -rf /var/lib/apt/lists/*
    
# Setup app
RUN mkdir -p /app

# Add application
WORKDIR /app
COPY challenge .

ENV FLAG=KCSC{R3g3x_1nJ3ct1on_t00_3z_t0_Expl0it}
ENV SECRET=super_secret_key_you_cannot_guess_ahihi
# Install dependencies
RUN yarn

CMD ["npm", "install"]
# Expose the port node-js is reachable on
EXPOSE 80

# Start the node-js application
CMD ["node", "index.js"]
