FROM node:current

WORKDIR /app
COPY ./frontend/package*.json ./
COPY ./frontend/yarn.lock ./
RUN yarn install

COPY ./frontend ./

EXPOSE 5173

CMD ["yarn", "dev", "--host"]
