var QBApp = {
  appId: 36224,
  authKey: 'MnpsZmX93GyFWaQ',
  authSecret: 'baDrRNkrqMce7JV'
};

var config = {
  chatProtocol: {
    active: 2
  },
  debug: {
    mode: 1,
    file: null
  }
};

QB.init(QBApp.appId, QBApp.authKey, QBApp.authSecret, config);