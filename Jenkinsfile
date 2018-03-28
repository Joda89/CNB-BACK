def label = "worker-${UUID.randomUUID().toString()}"

podTemplate(label: label, containers: [
  containerTemplate(name: 'composer', image: 'composer', command: 'cat', ttyEnabled: true),
  containerTemplate(name: 'docker', image: 'docker', command: 'cat', ttyEnabled: true),
  containerTemplate(name: 'helm', image: 'lachlanevenson/k8s-helm:latest', command: 'cat', ttyEnabled: true)
],
volumes: [
  hostPathVolume(mountPath: '/var/run/docker.sock', hostPath: '/var/run/docker.sock')
]) {
  node(label) {
    def myRepo = checkout scm
    def gitCommit = myRepo.GIT_COMMIT
    def gitBranch = myRepo.GIT_BRANCH
    def namespace = sh (script: """ echo ${env.JOB_NAME} | sed -e 's/\\([^-]*\\).*/\\L\1/' """,returnStdout: true).trim()
    stage('build') {
      try {
        container('composer') {
          sh "composer install"
        }
      }
      catch (exc) {
        println "Failed to test - ${currentBuild.fullDisplayName}"
        throw(exc)
      }
    }
    stage('Create Docker images') {
      container('docker') {
          sh """
	    docker build -t ${DOCKER_REGISTRY}/cnb/back:${gitCommit} .
	    docker tag ${DOCKER_REGISTRY}/cnb/back:${gitCommit} ${DOCKER_REGISTRY}/cnb/back:${gitBranch} 
            docker push ${DOCKER_REGISTRY}/cnb/back:${gitCommit}
	    docker push ${DOCKER_REGISTRY}/cnb/back:${gitBranch}
            """
      }
    }
    stage('Deployment') {
      container('helm') {
	      sh 'helm init --client-only'
	      sh "helm upgrade --wait -i --namespace ${namespace} --repo ${env.HELM_REPO} dev back-k8s "
      }
    }
  }
}
