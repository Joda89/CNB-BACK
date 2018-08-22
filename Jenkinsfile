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
    def namespace = sh (script: """ echo ${env.JOB_NAME} | sed -e 's/\\([^-]*\\).*/\\1/' """,returnStdout: true).trim()
    switch(gitBranch) {
      case "develop":
        prefix = "dev"
      break
      case "master":
        prefix = "prod"
      break
      default:
        prefix = ""
      break
    }
    
    }
  }
}



import org.lore.*

pipeline {

    options {
        // Build auto timeout
        timeout(time: 60, unit: 'MINUTES')
    }

    agent none

    stages {
        stage('build') {
            agent { docker 'composer' }
            steps {
                sh "composer install"
            }
        }
//        stage('Create Docker images') {
//            agent { docker 'docker' }
//                sh 'docker build -t ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} .'
//                sh 'docker tag ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} ${DOCKER_REGISTRY}/cnb/back:${env.BRANCH_NAME} ' 
//                sh 'docker push ${env.DOCKER_REGISTRY}/cnb/back:${env.GIT_COMMIT} '
//                sh 'docker push ${env.DOCKER_REGISTRY}/cnb/back:${env.BRANCH_NAME} '
//        }
    }
}