FROM node:14.15.2-alpine3.10

ENV DIR /app
WORKDIR ${DIR}

ENV PATH ${DIR}/node_modules/.bin:$PATH

COPY package.json .
COPY package-lock.json .

RUN npm install

COPY . .

CMD ["npm", "start"]